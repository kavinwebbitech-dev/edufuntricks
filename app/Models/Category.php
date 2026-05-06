<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
        'slug', 
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
