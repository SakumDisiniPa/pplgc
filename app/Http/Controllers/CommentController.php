<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Galeri $galeri)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->galeri_id = $galeri->id;

        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil dikirim.');
    }
}
