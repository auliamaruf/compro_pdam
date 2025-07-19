<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SeoSetting extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'page_type',
        'page_identifier',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical_url',
        'robots',
        'schema_markup',
        'is_active'
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'schema_markup' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForPage($query, $pageType, $identifier = null)
    {
        return $query->where('page_type', $pageType)
                    ->where('page_identifier', $identifier);
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['page_type', 'page_identifier', 'meta_title', 'meta_description', 'meta_keywords', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $page = $this->getAttribute('page_type') ?? 'Unknown';
                return "SEO setting '{$page}' {$eventName}";
            });
    }
}
