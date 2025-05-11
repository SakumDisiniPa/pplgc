<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionImage extends Model
{
    use HasFactory;

    protected $fillable = ['discussion_id', 'path'];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function destroyImage(DiscussionImage $image)
    {
        $this->authorize('delete', $image->discussion);
        
        // Delete file from storage
        Storage::disk('public')->delete($image->path);
        
        // Delete record from database
        $image->delete();
        
        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
