<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::orderBy('nama')->paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $jabatanOptions = [
            'Ketua Kelas',
            'Wakil Ketua',
            'Sekretaris',
            'Bendahara',
            'Kebersihan',
            'Keamanan',
            'Anggota'
        ];
        
        return view('admin.siswa.create', compact('jabatanOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:siswas|max:20',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'required|email|unique:siswas',
            'no_hp' => 'required|max:15',
            'instagram' => 'nullable|max:50',
            'facebook' => 'nullable|max:50',
            'jabatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('siswa', 'public');
        }

        Siswa::create($validated);

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        $jabatanOptions = [
            'Ketua Kelas',
            'Wakil Ketua',
            'Sekretaris',
            'Bendahara',
            'Kebersihan',
            'Keamanan',
            'Anggota'
        ];
        
        return view('admin.siswa.edit', compact('siswa', 'jabatanOptions'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|max:20|unique:siswas,nis,'.$siswa->id,
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'required|email|unique:siswas,email,'.$siswa->id,
            'no_hp' => 'required|max:15',
            'instagram' => 'nullable|max:50',
            'facebook' => 'nullable|max:50',
            'jabatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('siswa', 'public');
        }

        $siswa->update($validated);

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }
        
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
                         ->with('success', 'Data siswa berhasil dihapus');
    }
}