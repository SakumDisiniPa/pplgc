<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Comment; 

class Galeri extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'thumbnail',
        'slug',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<string>
     */
    protected $appends = [
        'thumbnail_url',
        'cover_image_url',
        'total_size_mb',
        'images_count'
    ];

    /**
     * Get the user that owns the gallery.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all images for the gallery.
     */
    public function images(): HasMany
    {
        return $this->hasMany(GaleriImage::class);
    }

    /**
     * Get the URL for the thumbnail.
     */
    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('storage/'.$this->thumbnail),
        );
    }

    /**
     * Get the first image as a cover image.
     */
    protected function coverImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Load the first image if not already loaded
                if (!$this->relationLoaded('firstImage')) {
                    $this->load(['firstImage' => function ($query) {
                        $query->orderBy('id')->limit(1);
                    }]);
                }
                
                return $this->firstImage?->url ?? $this->thumbnail_url;
            }
        );
    }

    /**
     * Get the first image relation for cover
     */
    public function firstImage(): HasOne
    {
        return $this->hasOne(GaleriImage::class)->orderBy('id')->limit(1);
    }

    /**
     * Get the total size of all images in MB.
     */
    protected function totalSizeMb(): Attribute
    {
        return Attribute::make(
            get: function () {
                // Optimized query to get sum without loading all images
                $sizeInBytes = $this->images()->sum('size');
                return round($sizeInBytes / (1024 * 1024), 2);
            }
        );
    }

    /**
     * Get the number of images in the gallery.
     */
    protected function imagesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->images()->count(),
        );
    }

    /**
     * Scope a query to only include popular galleries.
     */
    public function scopePopular($query)
    {
        return $query->withCount('images')
            ->orderBy('images_count', 'desc');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::deleting(function ($galeri) {
            // Delete all related images when gallery is deleted
            $galeri->images()->each(function ($image) {
                $image->delete(); // This will trigger GaleriImage's deleting event
            });
        });
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}