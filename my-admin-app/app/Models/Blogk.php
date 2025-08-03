<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner',
        'banner_alt',
        'image',
        'image_alt',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title);
            } else {
                $blog->slug = static::generateUniqueSlug($blog->slug);
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('slug')) {
                $blog->slug = static::generateUniqueSlug($blog->slug, $blog->id);
            } elseif ($blog->isDirty('title') && empty($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title, $blog->id);
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


    // Define the type key for the FileUploadService
    public static function getTypeKey(): string
    {
        return 'blogs'; // Or dynamically determine it
    }
}
