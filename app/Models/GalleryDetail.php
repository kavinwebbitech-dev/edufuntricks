<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    protected $fillable = [
        'gallery_id',
        'name',
        'image',
        'status'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
