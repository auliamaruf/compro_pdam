<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'meta',
        'sort_order',
        'show_in_menu',
        'template',
        'published_at'
    ];

    protected $casts = [
        'meta' => 'array',
        'show_in_menu' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Relationships
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
                   ->where('status', 'approved')
                   ->whereNull('parent_id')
                   ->orderBy('created_at', 'desc');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true);
    }

    // Media collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }
}
