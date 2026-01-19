<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_message',
        'total_quantity',
        'status',
        'quote_status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Client (optional)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Products (pivot table)
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'quote_request_products' // ✅ FIXED (plural)
        )
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Direct access to pivot rows
    public function quoteRequestProducts()
    {
        return $this->hasMany(QuoteRequestProduct::class);
    }

    // Activities / logs
    public function activities()
    {
        return $this->hasMany(QuoteActivity::class)
            ->orderBy('created_at', 'desc');
    }

    // Orders created from quote
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper / Business Logic
    |--------------------------------------------------------------------------
    */

    public function isExistingClient()
    {
        return !is_null($this->client_id);
    }

    public function canConvertToClient()
    {
        return !$this->isExistingClient()
            && $this->quote_status !== 'rejected';
    }

    public function canCreateOrder()
    {
        return $this->isExistingClient()
            && $this->quote_status !== 'rejected';
    }
}
