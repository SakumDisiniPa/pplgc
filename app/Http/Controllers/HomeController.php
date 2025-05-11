<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kegiatan;
use App\Models\Kas;
use App\Models\Galeri;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome', [
            'siswaCount' => \App\Models\Siswa::count(),
            'kegiatanCount' => \App\Models\Galeri::where('jenis', 'kegiatan')->count(),
            'guruCount' => \App\Models\Guru::count(),
            'kasCount' => \App\Models\Kas::sum('jumlah'), // Pastikan kolom ini ada
            'galeriKegiatan' => \App\Models\Galeri::where('jenis', 'kegiatan')
                                    ->latest()
                                    ->take(4)
                                    ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
