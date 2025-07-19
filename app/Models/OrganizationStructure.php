<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OrganizationStructure extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'name',
        'subtitle',
        'description',
        'icon',
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
