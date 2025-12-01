<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'email',
        'phone',
        'message',
        'terms_accepted_time',
        'ip_address',
        'user_agent',
        'is_replied',
        'reply_message',
        'replied_at',
    ];
}
