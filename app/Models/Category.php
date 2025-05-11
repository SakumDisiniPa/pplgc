<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Discussion;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Tambahkan relasi ke discussions
    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class);
    }
}