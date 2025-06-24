<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaGallery extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'category',
        'sort_order',
        'is_featured',
        'is_active',
        'published_at'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
              ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
              ->singleFile();

        $this->addMediaCollection('thumbnails')
              ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
              ->singleFile();
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('gallery');
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->getFirstMediaUrl('thumbnails') ?: $this->getFirstMediaUrl('gallery');
    }
}
