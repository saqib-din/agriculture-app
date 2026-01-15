<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'order_no',
        'order_date',
        'total_amount',
        'status',
        'notes',
    ];

    // ✅ Order belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
