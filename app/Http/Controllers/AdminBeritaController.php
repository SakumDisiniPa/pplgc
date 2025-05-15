<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('user')->latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
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

        Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $gambarPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('admin.berita.index')
               ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
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
            if ($berita->gambar) {
                $oldImage = Str::replaceFirst('storage/', 'public/', $berita->gambar);
                Storage::delete($oldImage);
            }

            $gambarPath = $request->file('gambar')->store('public/berita');
            $data['gambar'] = Str::replaceFirst('public/', 'storage/', $gambarPath);
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
               ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        Log::info('Berita sebelum dihapus:', [$berita]);

        if ($berita->gambar) {
            $imagePath = Str::replaceFirst('storage/', 'public/', $berita->gambar);
            Storage::delete($imagePath);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
