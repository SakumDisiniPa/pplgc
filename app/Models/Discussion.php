<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    // Tambahkan properti fillable untuk mengizinkan mass assignment
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category_id',
        'is_pinned', // Jika kamu gunakan flag pinned
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(DiscussionImage::class);
    }
}
