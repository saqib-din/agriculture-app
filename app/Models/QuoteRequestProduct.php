<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequestProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_request_id',
        'product_id',
        'quantity'
    ];

    public function quoteRequest()
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
