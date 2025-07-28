<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'banner', 'banner_alt','image', 'image_alt', 'meta_title', 'meta_description', 'meta_keyword', 'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = self::generateUniqueSlug($blog->slug ?? $blog->title);
        });

        static::updating(function ($blog) {
            // Only regenerate slug if it's changed
            if ($blog->isDirty('slug')) {
                $blog->slug = self::generateUniqueSlug($blog->slug ?? $blog->title, $blog->id);
            }
        });
    }

    protected static function generateUniqueSlug($baseSlug, $ignoreId = null)
    {
        $slug = Str::slug($baseSlug);
        $original = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}


