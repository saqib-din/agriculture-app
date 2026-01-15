<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_message',
        'total_quantity',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'quote_request_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function quoteRequestProducts()
    {
        return $this->hasMany(QuoteRequestProduct::class);
    }
}
