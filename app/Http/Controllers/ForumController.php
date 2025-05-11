<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function __construct()
    {
        // Hanya izinkan user login untuk buat forum dan komentar
        $this->middleware('auth')->only(['create', 'store', 'storeComment']);
    }

    public function index()
{
    $categories = Category::withCount('discussions')->get();
    
    $pinned = Discussion::where('is_pinned', true)
               ->when(request('category'), function($query) {
                   $query->where('category_id', request('category'));
               })
               ->with(['user', 'category', 'images'])
               ->withCount(['comments', 'images'])
               ->latest()
               ->get();
    
    $query = Discussion::query()
            ->when(request('category'), function($query) {
                $query->where('category_id', request('category'));
            })
            ->with(['user', 'category', 'images'])
            ->withCount(['comments', 'images']);
    
    if(request('sort') == 'popular') {
        $query->orderBy('comments_count', 'desc');
    } else {
        $query->latest();
    }
    
    $discussions = $query->paginate(10);
    
    // Add this line to count all discussions (for "All Categories" count)
    $totalDiscussions = Discussion::count();
    
    return view('forum.index', compact('categories', 'pinned', 'discussions', 'totalDiscussions'));
}

    public function show(Discussion $discussion)
    {
        $discussion->load(['user', 'comments.user']);
        return view('forum.show', compact('discussion'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image) {
                    $path = $image->store('discussion-images', 'public');
                    $discussion->images()->create(['path' => $path]);
                }
            }
        }

        return redirect()->route('forum.index')->with('success', 'Diskusi berhasil dibuat!');
    }

    public function storeComment(Request $request, Discussion $discussion)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $discussion->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    
}
