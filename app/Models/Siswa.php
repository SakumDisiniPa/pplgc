<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'jabatan',
        'alamat',
        'email',
        'instagram',
        'foto'
    ];

    public static $jabatanOptions = [
        'Ketua Kelas',
        'Wakil Ketua',
        'Bendahara',
        'Sekretaris',
        'Kebersihan',
        'Keamanan',
        'Anggota'
    ];
}