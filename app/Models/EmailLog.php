<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'order_id',
        'quote_request_id',

        'email_type',
        'recipient_email',
        'recipient_name',
        'subject',
        'status',
        'error_message',
        'attempt_number',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    // Relationship
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
