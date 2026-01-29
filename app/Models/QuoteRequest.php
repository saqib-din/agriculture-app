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
        'quote_status',
    ];

    // Client (optional)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Products (pivot table)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'quote_request_products')
            ->withPivot('quantity', 'price')
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

    public function emailLogs()
    {
        return $this->hasMany(EmailLog::class)->latest();
    }

    // Orders created from quote
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Single order relationship
    public function order()
    {
        return $this->hasOne(Order::class);
    }

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

    // Check if quote can be converted to order
    public function canConvertToOrder()
    {
        return $this->quote_status === 'pending'
            && $this->client_id !== null
            && !$this->order; // No existing order
    }

    // Check if quote can be rejected
    public function canReject()
    {
        return in_array($this->quote_status, ['new', 'pending']);
    }

    // Check if quote can be reopened
    public function canReopen()
    {
        return $this->quote_status === 'rejected';
    }

    // Check if quote is new
    public function isNew()
    {
        return $this->quote_status === 'new';
    }

    // Check if quote is pending
    public function isPending()
    {
        return $this->quote_status === 'pending';
    }

    // Check if quote is rejected
    public function isRejected()
    {
        return $this->quote_status === 'rejected';
    }

    // Check if quote is completed
    public function isCompleted()
    {
        return $this->quote_status === 'completed';
    }

    // Check if quote is converted
    public function isConverted()
    {
        return $this->quote_status === 'converted';
    }

    // Get status badge HTML
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'new' => '<span class="badge bg-light-info">New</span>',
            'pending' => '<span class="badge bg-light-warning">Pending</span>',
            'converted' => '<span class="badge bg-light-primary">Converted</span>',
            'completed' => '<span class="badge bg-light-success">Completed</span>',
            'rejected' => '<span class="badge bg-light-danger">Rejected</span>',
        ];

        return $badges[$this->quote_status] ?? '<span class="badge bg-light-secondary">' . ucfirst($this->quote_status) . '</span>';
    }

    // Get status label
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->quote_status));
    }


    // Scope for new quotes
    public function scopeNew($query)
    {
        return $query->where('quote_status', 'new');
    }

    // Scope for pending quotes
    public function scopePending($query)
    {
        return $query->where('quote_status', 'pending');
    }

    // Scope for rejected quotes
    public function scopeRejected($query)
    {
        return $query->where('quote_status', 'rejected');
    }

    // Scope for completed quotes
    public function scopeCompleted($query)
    {
        return $query->where('quote_status', 'completed');
    }

    // Scope for active quotes (new + pending)
    public function scopeActive($query)
    {
        return $query->whereIn('quote_status', ['new', 'pending']);
    }
}
