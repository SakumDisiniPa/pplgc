<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'user_id'
    ];

    /**
     * Get the user that owns the galeri.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}