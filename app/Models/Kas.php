<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';

    protected $fillable = [
        'jumlah',
        'keterangan',
        'pemasukan',
        'pengeluaran',
        'user_id',
    ];

    // Scope: hanya pemasukan
    public function scopePemasukan($query)
    {
        return $query->where('pemasukan', '>', 0);
    }

    // Scope: hanya pengeluaran
    public function scopePengeluaran($query)
    {
        return $query->where('pengeluaran', '>', 0);
    }

    // Fungsi untuk total pemasukan
    public static function totalPemasukan()
    {
        return self::sum('pemasukan');
    }

    // Fungsi untuk total pengeluaran
    public static function totalPengeluaran()
    {
        return self::sum('pengeluaran');
    }

    // Fungsi saldo kas (pemasukan - pengeluaran)
    public static function saldo()
    {
        return self::totalPemasukan() - self::totalPengeluaran();
    }
}
