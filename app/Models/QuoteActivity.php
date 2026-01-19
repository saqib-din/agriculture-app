<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_request_id',
        'type',
        'details'
    ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'call' => 'ti-phone',
            'message' => 'ti-message',
            'meeting' => 'ti-users',
            'email' => 'ti-mail',
            default => 'ti-clipboard'
        };
    }

    public function getTypeColorAttribute()
    {
        return match ($this->type) {
            'call' => 'info',
            'message' => 'primary',
            'meeting' => 'warning',
            'email' => 'secondary',
            default => 'light'
        };
    }
}
