<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'category',
        'requirements',
        'process_time',
        'fee',
        'procedure',
        'contact_person',
        'contact_phone',
        'forms',
        'sort_order',
        'is_active',
        'is_featured',
        'show_in_navbar',
        'navbar_order',
        'navbar_label',
        'navbar_icon',
        'is_navbar_featured'
    ];

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('navbar_services');
            \Illuminate\Support\Facades\Cache::forget('home_services');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('navbar_services');
            \Illuminate\Support\Facades\Cache::forget('home_services');
        });
    }

    protected $casts = [
        'requirements' => 'array',
        'forms' => 'array',
        'fee' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'show_in_navbar' => 'boolean',
        'navbar_order' => 'integer',
        'is_navbar_featured' => 'boolean'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeForNavbar($query)
    {
        return $query->where('show_in_navbar', true)
                    ->where('is_active', true)
                    ->orderBy('navbar_order')
                    ->orderBy('name');
    }

    // Accessors
    public function getNavbarDisplayNameAttribute()
    {
        return $this->navbar_label ?: $this->name;
    }

    public function getNavbarDisplayIconAttribute()
    {
        return $this->navbar_icon ?: $this->icon;
    }

    // Media collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icons')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp']);

        $this->addMediaCollection('forms')
            ->acceptsMimeTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'description', 'icon', 'category', 'requirements', 'process_time', 'cost', 'is_online', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $name = $this->getAttribute('name') ?? 'Unknown';
                return "Layanan '{$name}' {$eventName}";
            });
    }
}
