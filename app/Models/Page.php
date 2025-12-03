<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'status',
        'display_in_footer'
    ];

    // Automatically generate slug from name
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->name);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('name') && empty($page->slug)) {
                $page->slug = Str::slug($page->name);
            }
        });
    }

    // Scope for active pages
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    // Scope for footer pages
    public function scopeFooter($query)
    {
        return $query->where('display_in_footer', 'yes');
    }
}
