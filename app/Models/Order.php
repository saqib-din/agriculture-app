<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'client_id',
        'quote_request_id',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'discount',
        'total',
        'status',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-' . date('Y') . '-' . str_pad(Order::count() + 1, 5, '0', STR_PAD_LEFT);

            // Default status is 'new'
            if (empty($order->status)) {
                $order->status = 'new';
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'price', 'subtotal')
            ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(OrderActivity::class)->orderBy('created_at', 'desc');
    }

    // Helper methods
    public function isNew()
    {
        return $this->status === 'new';
    }

    public function isProcessing()
    {
        return $this->status === 'processing';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function canBeReopened()
    {
        return in_array($this->status, ['completed', 'cancelled']);
    }

    public function canGenerateInvoice()
    {
        return !$this->isCancelled();
    }
}
