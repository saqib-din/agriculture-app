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

    protected $casts = [
        'display_in_footer' => 'boolean'
    ];

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

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeFooter($query)
    {
        return $query->where('display_in_footer', 1);
    }
}
