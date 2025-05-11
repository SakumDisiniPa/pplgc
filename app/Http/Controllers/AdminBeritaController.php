<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'gambar' => 'required|image|max:2048'
        ]);

        // Upload gambar
        $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        $data['user_id'] = auth()->id();

        Berita::create($data);

        return redirect()->route('admin.berita.index')
               ->with('success', 'Berita berhasil ditambahkan!');
    }

    // ... (Edit, Update, Destroy methods)
}