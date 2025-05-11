<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $fillable = [
        'jumlah',
        'keterangan',
        'jenis'
    ];

    // Scope untuk pemasukan
    public function scopePemasukan($query)
    {
        return $query->where('jenis', 'masuk');
    }

    // Scope untuk pengeluaran
    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'keluar');
    }

    // Hitung saldo saat ini
    public static function saldo()
    {
        $pemasukan = self::pemasukan()->sum('jumlah');
        $pengeluaran = self::pengeluaran()->sum('jumlah');
        return $pemasukan - $pengeluaran;
    }
}