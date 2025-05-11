<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Discussion;
use App\Models\Kas;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Activity;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'siswa' => Siswa::count(),
            'guru' => Guru::count(),
            'berita' => Berita::count(),
            'galeri' => Galeri::count(),
            'forum' => Discussion::count(),
            'saldo' => Kas::sum('pemasukan') - Kas::sum('pengeluaran'),
            'users' => User::count()
        ];

        $recentActivities = Activity::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}