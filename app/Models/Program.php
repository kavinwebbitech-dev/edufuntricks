<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'label',
        'thumbnail',
        'pdf'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
