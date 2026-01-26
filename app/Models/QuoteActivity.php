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
        'title',
        'details',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    // Accessors
    public function getTypeColorAttribute()
    {
        return match ($this->type) {
            'call' => 'info',
            'message' => 'primary',
            'meeting' => 'warning',
            'email' => 'success',
            'payment' => 'success',
            'other' => 'secondary',
            default => 'secondary',
        };
    }

    public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'call' => 'ti-phone',
            'message' => 'ti-message',
            'meeting' => 'ti-users',
            'email' => 'ti-mail',
            'payment' => 'ti-currency-dollar',
            'other' => 'ti-note',
            default => 'ti-note',
        };
    }
}
