<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomerInfo extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'title',
        'description',
        'is_active',
        'published_date',
        'category',
        'display_until',
        'repair_start',
        'repair_end',
        'promo_start',
        'promo_end',
        'affected_areas',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_date' => 'date',
        'display_until' => 'datetime',
        'repair_start' => 'datetime',
        'repair_end' => 'datetime',
        'promo_start' => 'date',
        'promo_end' => 'date',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('webp')
             ->format('webp')
             ->nonQueued();
    }
}
