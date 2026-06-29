<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class News extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity;

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget("home_news");
        });
        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget("home_news");
        });
    }

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'type',
        'status',
        'is_featured',
        'is_emergency',
        'views',
        'meta',
        'documents',
        'document_links',
        'has_documents',
        'published_at',
        'author_id',
        'comments_enabled'
    ];

    protected $casts = [
        'meta' => 'array',
        'documents' => 'array',
        'document_links' => 'array',
        'is_featured' => 'boolean',
        'is_emergency' => 'boolean',
        'comments_enabled' => 'boolean',
        'has_documents' => 'boolean',
        'published_at' => 'datetime'
    ];

    protected $dates = [
        'published_at'
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
                   ->where('status', 'approved')
                   ->whereNull('parent_id')
                   ->orderBy('created_at', 'desc');
    }

    public function allComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Media collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('documents')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'text/plain',
                'image/jpeg',
                'image/png',
                'image/webp'
            ]);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(400)
            ->quality(80);
    }

    // Helper methods
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    // Document helpers
    

    public function getUploadedDocumentsAttribute()
    {
        return $this->getMedia('documents');
    }

    public function getAllDocumentsAttribute()
    {
        $documents = collect([]);
        
        // Add uploaded files
        foreach ($this->getMedia('documents') as $media) {
            $documents->push([
                'type' => 'file',
                'name' => $media->name,
                'original_name' => $media->file_name,
                'size' => $media->size,
                'mime_type' => $media->mime_type,
                'url' => $media->getUrl(),
                'download_url' => $media->getUrl(),
                'created_at' => $media->created_at,
            ]);
        }
        
        // Add URL links
        if ($this->documents) {
            foreach ($this->documents as $doc) {
                if ($doc['type'] === 'url') {
                    $documents->push([
                        'type' => 'url',
                        'name' => $doc['title'],
                        'description' => $doc['description'] ?? null,
                        'url' => $doc['url'],
                        'created_at' => $doc['created_at'] ?? null,
                    ]);
                }
            }
        }
        
        return $documents;
    }

    public function hasDocuments()
    {
        return $this->has_documents || 
               $this->getMedia('documents')->count() > 0 || 
               ($this->documents && count($this->documents) > 0) ||
               ($this->document_links && count($this->document_links) > 0);
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'slug', 'excerpt', 'content', 'type', 'status', 'is_featured', 'published_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $title = $this->getAttribute('title') ?? 'Unknown';
                return "Berita '{$title}' {$eventName}";
            });
    }
}
