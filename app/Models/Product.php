<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',  
        'model',
        'brand',
        'price',
        'quantity',
        'brief_details',
        'description',
        'status',
        'quantity_display',
        'price_display'
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    // Relationships
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class)->orderBy('order');
    }

    public function quoteRequests()
    {
        return $this->belongsToMany(QuoteRequest::class, 'quote_request_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return 'PKR ' . number_format($this->price, 2);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }
}
