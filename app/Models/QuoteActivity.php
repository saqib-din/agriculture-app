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
    public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'call' => 'ti-phone',
            'message' => 'ti-message',
            'meeting' => 'ti-users',
            'email' => 'ti-mail',
            // 'payment' => 'ti-credit-card',
            'status_change' => 'ti-refresh',
            'error' => 'ti-alert-circle',
            default => 'ti-clipboard'
        };
    }

    public function getTypeColorAttribute()
    {
        return match ($this->type) {
            'call' => 'info',
            'message' => 'success',
            'meeting' => 'warning',
            'email' => 'primary',
            // 'payment' => 'success',
            'status_change' => 'info',
            'error' => 'danger',
            default => 'secondary'
        };
    }
}
