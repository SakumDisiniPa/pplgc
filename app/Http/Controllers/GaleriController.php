<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan gambar ke storage
        $path = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path, // Ini akan menyimpan 'galeri/nama-file.jpg'
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('galeri.index')
            ->with('success', 'Gambar berhasil diupload!');
    }

    public function show(Galeri $galeri)
    {
        return view('galeri.show', compact('galeri'));
    }

    public function destroy(Galeri $galeri)
    {
        $this->authorize('delete', $galeri);
        
        // Hapus gambar dari storage
        $imagePath = str_replace('storage/', 'public/', $galeri->gambar);
        Storage::delete($imagePath);

        $galeri->delete();

        return back()->with('success', 'Gambar berhasil dihapus!');
    }
}