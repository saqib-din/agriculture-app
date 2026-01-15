<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'status',

        'street',
        'city',
        'state',
        'country',
        'zip_code',
        'ntn_gst',
        'image',
    ];

    // ✅ Client has many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
