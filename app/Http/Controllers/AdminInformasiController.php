<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class AdminInformasiController extends Controller
{
    public function index()
    {
        try {
            // Ambil ketua dan wakil
            $ketua = Siswa::where('jabatan', 'Ketua Kelas')->first();
            $wakil = Siswa::where('jabatan', 'Wakil Ketua')->first();
            
            // Ambil pengurus lainnya
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
            
            // Ambil guru
            $gurus = Guru::orderBy('jabatan')->get();
            
            // Hitung jumlah siswa
            $jumlahSiswa = Siswa::count();

            return view('admin.informasi.index', [
                'ketua' => $ketua,
                'wakil' => $wakil,
                'pengurus' => $pengurus,
                'gurus' => $gurus,
                'jumlahSiswa' => $jumlahSiswa
            ]);

        } catch (\Exception $e) {
            return view('admin.informasi.index', [
                'error' => 'Data struktur kelas belum tersedia',
                'ketua' => null,
                'wakil' => null,
                'pengurus' => collect(),
                'gurus' => collect(),
                'jumlahSiswa' => 0
            ]);
        }
    }
}