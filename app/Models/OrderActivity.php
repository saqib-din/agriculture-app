<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class OrderActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'details'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'call' => 'ti-phone',
            'message' => 'ti-message',
            'meeting' => 'ti-users',
            'email' => 'ti-mail',
            'payment' => 'ti-credit-card',
            'status_change' => 'ti-refresh',
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
            'payment' => 'success',
            'status_change' => 'info',
            default => 'light'
        };
    }
}
