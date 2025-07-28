<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CompanySetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $fillable = [
        // Identitas Perusahaan
        'company_name',
        'company_tagline', 
        'company_description',
        'vision',
        'mission',
        'vision_description',
        'mission_points',
        
        // Kontak
        'phone',
        'email',
        'whatsapp_cs',
        'address',
        'office_hours',
        
        // Media (file paths untuk backward compatibility)
        'logo',
        'logo_white',
        'favicon',
        
        // Hero Section
        'hero_title',
        'hero_subtitle',
        'hero_cta_primary',
        'hero_cta_secondary',
        'hero_slides',
        
        // Company History
        'company_history',
        'history_timeline',
        'achievements',
        
        // Statistik
        'years_experience',
        'customers_served',
        'water_quality_percentage',
        'service_availability',
        
        // JSON Data
        'social_media',
        'core_values',
        
        // Home Page Content
        'about_preview_title',
        'about_preview_description',
        'about_preview_content',
        'key_features',
        'quick_services',
        'stats_section_title',
        'stats_section_description',
        'services_section_title',
        'services_section_description',
        'news_section_title',
        'news_section_description',
        'quick_actions_title',
        'quick_actions_description',
        'quick_actions_items',
        
        // Status
        'is_active'
    ];

    protected $casts = [
        'mission_points' => 'array',
        'office_hours' => 'array',
        'hero_slides' => 'array',
        'history_timeline' => 'array',
        'achievements' => 'array',
        'social_media' => 'array',
        'core_values' => 'array',
        'key_features' => 'array',
        'quick_services' => 'array',
        'quick_actions_items' => 'array',
        'is_active' => 'boolean',
        'years_experience' => 'integer',
        'customers_served' => 'integer',
        'water_quality_percentage' => 'decimal:1'
    ];

    /**
     * Get the active company setting
     */
    public static function current()
    {
        return static::where('is_active', true)->first() ?? static::first();
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']);

        $this->addMediaCollection('logo_white')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']);

        $this->addMediaCollection('favicon')
            ->singleFile()
            ->acceptsMimeTypes(['image/x-icon', 'image/png']);

        $this->addMediaCollection('about_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('vision_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    /**
     * Register media conversions
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10);
    }

    /**
     * Get logo URL - checks media library first, then fallback to file path
     */
    public function getLogoUrlAttribute()
    {
        return $this->getFirstMediaUrl('logo') ?: ($this->logo ? asset('storage/' . $this->logo) : null);
    }

    /**
     * Get white logo URL
     */
    public function getLogoWhiteUrlAttribute()
    {
        return $this->getFirstMediaUrl('logo_white') ?: ($this->logo_white ? asset('storage/' . $this->logo_white) : null);
    }

    /**
     * Get favicon URL
     */
    public function getFaviconUrlAttribute()
    {
        return $this->getFirstMediaUrl('favicon') ?: ($this->favicon ? asset('storage/' . $this->favicon) : null);
    }

    /**
     * Get about image URL
     */
    public function getAboutImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('about_image');
    }

    /**
     * Get vision image URL
     */
    public function getVisionImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('vision_image');
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'company_name', 'company_tagline', 'company_description', 
                'vision', 'mission', 'phone', 'email', 'whatsapp_cs', 
                'address', 'office_hours', 'website', 'facebook', 
                'twitter', 'instagram', 'youtube', 'linkedin'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Pengaturan perusahaan {$eventName}");
    }
}
