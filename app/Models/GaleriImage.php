<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GaleriImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'galeri_id',
        'path',
        'original_name',
        'size',
        'mime_type', // tambahkan jika diperlukan
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<string>
     */
    protected $appends = [
        'url',
        'size_in_mb'
    ];

    /**
     * Get the image URL.
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('storage/'.$this->path),
        );
    }

    /**
     * Get the image size in MB.
     */
    protected function sizeInMb(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->size / (1024 * 1024), 2),
        );
    }

    /**
     * Get the gallery that owns the image.
     */
    public function galeri(): BelongsTo
    {
        return $this->belongsTo(Galeri::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::deleting(function (GaleriImage $image) {
            // Delete the file when model is deleted
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
        });
    }
}