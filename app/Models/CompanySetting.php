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
        
        // Sambutan Direksi
        'director_name',
        'director_position',
        'director_message',
        'message_title',
        'show_director_message',
        
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('company_setting_current');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('company_setting_current');
        });
    }

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
        'show_director_message' => 'boolean',
        'years_experience' => 'integer',
        'customers_served' => 'integer',
        'water_quality_percentage' => 'decimal:1'
    ];

    /**
     * Get the active company setting with default fallback
     */
    public static function current()
    {
        $setting = static::where('is_active', true)->first() ?? static::first();
        
        // If no setting exists, create a default object with all required fields
        if (!$setting) {
            $setting = new static();
            $setting->company_name = 'PDAM Tirta Perwira';
            $setting->company_tagline = 'Air Bersih Untuk Kehidupan Yang Lebih Baik';
            $setting->company_description = '<p>Perumda Air Minum Tirta Perwira adalah perusahaan daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga.</p>';
            $setting->vision = 'Menjadi perusahaan air minum terdepan di Jawa Tengah yang memberikan pelayanan prima dan berkelanjutan';
            $setting->mission = 'Memberikan pelayanan air bersih berkualitas tinggi kepada masyarakat';
            $setting->vision_description = 'Visi kami adalah menjadi perusahaan air minum yang terdepan dengan standar pelayanan prima dan berkelanjutan.';
            $setting->mission_points = [
                ['title' => 'Penyediaan Air Berkualitas', 'description' => 'Menyediakan air bersih yang memenuhi standar kesehatan dan kualitas nasional.'],
                ['title' => 'Pelayanan Prima', 'description' => 'Memberikan pelayanan terbaik dengan sistem informasi yang terintegrasi.'],
                ['title' => 'Pengembangan Berkelanjutan', 'description' => 'Melakukan pengembangan infrastruktur secara berkelanjutan.']
            ];
            $setting->about_preview_content = '<p><strong class="text-gray-900">PDAM Tirta Perwira</strong> telah mengabdi kepada masyarakat Purbalingga selama lebih dari 50 tahun dalam menyediakan air bersih berkualitas. Kami berkomitmen melayani dengan hati dan memberikan pelayanan terbaik untuk kehidupan yang lebih baik.</p>';
            $setting->phone = '(0281) 891234';
            $setting->email = 'info@pdamtirtaperwira.com';
            $setting->whatsapp_cs = '6282134567890';
            $setting->address = 'Jl. Letjen S. Parman No. 53, Purbalingga, Jawa Tengah 53311';
            $setting->office_hours = 'Senin - Jumat: 08:00 - 16:00 WIB';
            $setting->hero_title = 'Air Bersih Berkualitas untuk Kehidupan yang Lebih Baik';
            $setting->hero_subtitle = 'PDAM Tirta Perwira melayani kebutuhan air bersih masyarakat Purbalingga dengan standar kualitas terbaik';
            $setting->hero_cta_primary = 'Layanan Kami';
            $setting->hero_cta_secondary = 'Hubungi Kami';
            $setting->is_active = true;
        }
        
        return $setting;
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
     * Get director photo URL
     */
    public function getDirectorPhotoUrlAttribute()
    {
        return $this->getFirstMediaUrl('director_photo');
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
