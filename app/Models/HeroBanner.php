<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HeroBanner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected static function booted()
    {
        // Standard Laravel model events untuk melengkapi activity log
        static::created(function ($model) {
            // Additional logging jika diperlukan
        });

        static::updated(function ($model) {
            // Additional logging jika diperlukan
        });
    }

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'background_image',
        'overlay_color',
        'overlay_opacity',
        'text_position',
        'primary_cta_text',
        'primary_cta_link',
        'secondary_cta_text',
        'secondary_cta_link',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'overlay_opacity' => 'integer',
        'sort_order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_backgrounds')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'title', 'subtitle', 'description', 'background_image',
                'overlay_color', 'overlay_opacity', 'text_position',
                'primary_cta_text', 'primary_cta_link', 
                'secondary_cta_text', 'secondary_cta_link',
                'sort_order', 'is_active'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $title = $this->getAttribute('title') ?? 'Unknown';
                return "Hero Banner '{$title}' {$eventName}";
            })
            ->dontLogIfAttributesChangedOnly(['updated_at']);
    }
}
