<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class WaterSource extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'address',
        'production_capacity',
        'status',
        'ownership',
        'distribution_area',
        'description',
        'photo',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'production_capacity' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope untuk mendapatkan sumber air yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get status label dalam bahasa Indonesia
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'active' => 'Aktif',
            'inactive' => 'Tidak Aktif',
            'maintenance' => 'Maintenance',
            default => ucfirst($this->status)
        };
    }

    /**
     * Get ownership label dalam bahasa Indonesia
     */
    public function getOwnershipLabelAttribute()
    {
        return match($this->ownership) {
            'milik_sendiri' => 'Milik Sendiri',
            'sewa' => 'Sewa',
            'kerjasama' => 'Kerjasama',
            default => ucfirst($this->ownership)
        };
    }

    /**
     * Get formatted production capacity
     */
    public function getFormattedProductionCapacityAttribute()
    {
        return number_format((float) $this->production_capacity, 2, ',', '.') . ' L/detik';
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Register media conversions
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10)
            ->performOnCollections('photo');

        $this->addMediaConversion('large')
            ->width(800)
            ->height(600)
            ->sharpen(10)
            ->performOnCollections('photo');
    }

    /**
     * Get location attribute (alias for address)
     */
    public function getLocationAttribute()
    {
        return $this->address;
    }

    /**
     * Get photo URL
     */
    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMediaUrl('photo') ?: asset('images/default-water-source.jpg');
    }

    /**
     * Get photo thumb URL
     */
    public function getPhotoThumbUrlAttribute()
    {
        return $this->getFirstMediaUrl('photo', 'thumb') ?: asset('images/default-water-source-thumb.jpg');
    }
}
