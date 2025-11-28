<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'status',
        'description',
        'phone',
        'email',
        'linkedin',
        'facebook',
        'instagram',
        'is_ceo',
        'image'
    ];
}
