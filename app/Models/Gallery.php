<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['section_key', 'title', 'status'];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
