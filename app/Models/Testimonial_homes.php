<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial_homes extends Model
{
     protected $fillable = [
        'name',
        'designation',
        'message',
        'image',
        'status'
    ];
}



