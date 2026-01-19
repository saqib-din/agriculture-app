<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'image',
        'status',
        'notes'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }
}
