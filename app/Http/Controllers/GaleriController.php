<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $galeris = Galeri::query()
            ->with(['user', 'images' => function ($query) {
                $query->latest()->take(1); // Hanya ambil 1 gambar terbaru untuk preview
            }])
            ->withCount('images')
            ->latest()
            ->paginate(12);
            
        return view('galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
{
    // Validasi lebih eksplisit
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        'gallery_images' => 'required|array|min:1',
        'gallery_images.*' => 'image|mimes:jpeg,png,jpg|max:15360',
    ], [
        'gallery_images.required' => 'Minimal upload 1 gambar',
        'thumbnail.required' => 'Thumbnail wajib diupload',
    ]);

    try {
        DB::beginTransaction();

        // Upload thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('galeri/thumbnails', 'public');

        // Buat galeri
        $galeri = Galeri::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'thumbnail' => $thumbnailPath,
            'user_id' => auth()->id(),
            'slug' => Str::slug($validated['judul']) . '-' . uniqid(),
        ]);

        // Upload gambar galeri
        foreach ($request->file('gallery_images') as $image) {
            $path = $image->store('galeri/images', 'public');
            
            GaleriImage::create([
                'galeri_id' => $galeri->id,
                'path' => $path,
                'original_name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
            ]);
        }

        DB::commit();

        return redirect()->route('galeri.show', $galeri->slug)
               ->with('success', 'Galeri berhasil dibuat!');

    } catch (\Exception $e) {
        DB::rollBack();
        
        // Hapus file yang sudah terupload jika ada error
        if (isset($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }
        
        return back()->with('error', 'Gagal membuat galeri: ' . $e->getMessage())
                    ->withInput();
    }
}

    public function show($slug)
    {
        $galeri = Galeri::with(['user', 'images', 'comments.user'])
            ->withCount(['images', 'comments'])
            ->where('slug', $slug)
            ->firstOrFail();
            
        return view('galeri.show', compact('galeri'));
    }

    public function destroy(Galeri $galeri)
    {
        $this->authorize('delete', $galeri);
        
        DB::beginTransaction();

        try {
            // Kumpulkan semua path yang akan dihapus
            $pathsToDelete = [$galeri->thumbnail];
            foreach ($galeri->images as $image) {
                $pathsToDelete[] = $image->path;
            }

            // Hapus galeri dan relasinya
            $galeri->images()->delete();
            $galeri->delete();

            // Hapus file-file dari storage
            Storage::disk('public')->delete($pathsToDelete);

            DB::commit();

            return redirect()->route('galeri.index')
                ->with('success', 'Galeri berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus galeri: '.$e->getMessage());
        }
    }
}