<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CompanySetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'company_name',
        'company_tagline',

        // Logo & Branding
        'logo',
        'logo_white',
        'favicon',
        'primary_color',
        'secondary_color',
        'brand_description',

        'address',
        'phone',
        'email',
        'website',
        'emergency_phone',
        'whatsapp_cs',
        'about_us',
        'vision',
        'mission',

        // Hero Section
        'hero_title',
        'hero_subtitle',
        'hero_cta_primary',
        'hero_cta_secondary',
        'hero_description',
        'hero_slides',

        // About Us - Company Profile
        'company_description',
        'company_history',
        'company_values',
        'milestones',

        // About Us - History
        'history_timeline',
        'achievements',
        'legacy_description',

        // About Us - Vision & Mission
        'vision_description',
        'mission_points',
        'core_values',

        // About Us - Organization
        'organization_structure_description',
        'organization_structure',
        'leadership_team',
        'organizational_culture',

        // Statistics & Metrics
        'years_experience',
        'customers_served',
        'water_quality_percentage',
        'service_availability',

        'primary_color',
        'secondary_color',
        'accent_color',
        'social_media',
        'office_hours',
        'is_active'
    ];

    protected $casts = [
        'social_media' => 'array',
        'office_hours' => 'array',
        'company_values' => 'array',
        'milestones' => 'array',
        'history_timeline' => 'array',
        'achievements' => 'array',
        'mission_points' => 'array',
        'core_values' => 'array',
        'organization_structure' => 'array',
        'leadership_team' => 'array',
        'organizational_culture' => 'array',
        'hero_slides' => 'array',
        'years_experience' => 'integer',
        'customers_served' => 'integer',
        'water_quality_percentage' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Media collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/svg+xml']);

        $this->addMediaCollection('logo_white')
            ->singleFile()
            ->acceptsMimeTypes(['image/png', 'image/svg+xml']);

        $this->addMediaCollection('favicon')
            ->singleFile()
            ->acceptsMimeTypes(['image/png', 'image/ico', 'image/svg+xml']);

        $this->addMediaCollection('banners')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);

        $this->addMediaCollection('hero_slides')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->useDisk('public');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('banner')
            ->width(1200)
            ->height(600)
            ->quality(80);
    }

    // Helper methods
    public static function current()
    {
        return static::where('is_active', true)->first() ?? static::first();
    }
}
