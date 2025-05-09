<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user') // Eager load relasi user
                    ->latest()
                    ->paginate(6);
                    
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/berita');
            $gambarPath = Str::replaceFirst('public/', 'storage/', $gambarPath);
        }

        $berita = Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $gambarPath,
            'user_id' => Auth::id() // Tambahkan user yang membuat berita
        ]);

        return redirect()->route('berita.index')
               ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        // Increment hit counter
        $berita->increment('views_count');
        
        // Load relasi user
        $berita->load('user');
        
        return view('berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                $oldImage = Str::replaceFirst('storage/', 'public/', $berita->gambar);
                Storage::delete($oldImage);
            }
            
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('public/berita');
            $data['gambar'] = Str::replaceFirst('public/', 'storage/', $gambarPath);
        }

        $berita->update($data);

        return redirect()->route('berita.show', $berita)
               ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        // Hapus gambar terkait jika ada
        if ($berita->gambar) {
            $imagePath = Str::replaceFirst('storage/', 'public/', $berita->gambar);
            Storage::delete($imagePath);
        }

        $berita->delete();

        return redirect()->route('berita.index')
               ->with('success', 'Berita berhasil dihapus.');
    }
}