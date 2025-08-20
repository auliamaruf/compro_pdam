<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrganizationStructure extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'title',
        'name',
        'subtitle',
        'description',
        'icon',
        'photo',
        'level',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Scope untuk mendapatkan struktur aktif berdasarkan level
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('level')->orderBy('sort_order');
    }

    /**
     * Get organization structure grouped by level
     */
    public static function getGroupedByLevel()
    {
        return self::active()
            ->ordered()
            ->get()
            ->groupBy('level');
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('staff_photos')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->singleFile();
    }

    /**
     * Register media conversions
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->performOnCollections('staff_photos');

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->performOnCollections('staff_photos');
    }

    /**
     * Get staff photo URL with fallback
     */
    public function getPhotoUrl($conversion = null)
    {
        if ($this->hasMedia('staff_photos')) {
            return $conversion 
                ? $this->getFirstMediaUrl('staff_photos', $conversion)
                : $this->getFirstMediaUrl('staff_photos');
        }
        
        return null;
    }

    /**
     * Check if has photo
     */
    public function hasPhoto(): bool
    {
        return $this->hasMedia('staff_photos');
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'name', 'subtitle', 'level', 'parent_id', 'sort_order', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $name = $this->getAttribute('name') ?? 'Unknown';
                return "Struktur organisasi '{$name}' {$eventName}";
            });
    }
}
