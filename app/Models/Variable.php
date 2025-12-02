<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'fax',
        'working_hours',
        'linkedin',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'map',
        'slogan',
        'reg',
        'about_us',
        'company_mission',
        'company_vision',
        'address',
    ];
}
