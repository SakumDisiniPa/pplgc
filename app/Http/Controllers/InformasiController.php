<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        try {
            // Ambil ketua dan wakil
            $ketua = Siswa::where('jabatan', 'Ketua Kelas')->firstOrFail();
            $wakil = Siswa::where('jabatan', 'Wakil Ketua')->firstOrFail();
            
            // Ambil pengurus lainnya sesuai urutan
            $pengurus = Siswa::whereIn('jabatan', [
                    'Bendahara', 
                    'Sekretaris', 
                    'Kebersihan', 
                    'Keamanan', 
                    'Anggota'
                ])
                ->orderByRaw("FIELD(jabatan, 'Bendahara', 'Sekretaris', 'Kebersihan', 'Keamanan', 'Anggota')")
                ->get()
                ->groupBy('jabatan');
            
            // Ambil guru berdasarkan jabatan
            $gurus = Guru::orderBy('jabatan')->get();
            
            // Hitung jumlah siswa
            $jumlahSiswa = Siswa::count();

            return view('informasi.index', [
                'ketua' => $ketua,
                'wakil' => $wakil,
                'pengurus' => $pengurus,
                'gurus' => $gurus,
                'jumlahSiswa' => $jumlahSiswa
            ]);

        } catch (\Exception $e) {
            return view('informasi.index', [
                'error' => 'Data struktur kelas belum tersedia',
                'ketua' => null,
                'wakil' => null,
                'pengurus' => collect(),
                'gurus' => collect(),
                'jumlahSiswa' => 0
            ])->withErrors(['message' => $e->getMessage()]);
        }
    }
}
