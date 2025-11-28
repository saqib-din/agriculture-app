<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'review',
        'design',
        'company',
        'image',
        'rating',
        'status'
    ];
}
