<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class WaterTariff extends Model
{
    use LogsActivity;
    protected $fillable = [
        'customer_type',
        'description',
        'min_usage',
        'max_usage',
        'rate_per_m3',
        'admin_fee',
        'maintenance_fee',
        'effective_date',
        'expired_date',
        'is_active',
        'sort_order',
        'notes',
        'show_in_navbar',
        'navbar_order',
        'navbar_label',
        'navbar_icon',
        'is_navbar_featured'
    ];

    protected $casts = [
        'rate_per_m3' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'maintenance_fee' => 'decimal:2',
        'effective_date' => 'date',
        'expired_date' => 'date',
        'is_active' => 'boolean',
        'show_in_navbar' => 'boolean',
        'navbar_order' => 'integer',
        'is_navbar_featured' => 'boolean'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        return $query->where('effective_date', '<=', now())
                    ->where(function($q) {
                        $q->whereNull('expired_date')
                          ->orWhere('expired_date', '>=', now());
                    });
    }

    public function scopeForNavbar($query)
    {
        return $query->where('show_in_navbar', true)
                    ->active()
                    ->current()
                    ->orderBy('navbar_order')
                    ->orderBy('customer_type')
                    ->orderBy('min_usage');
    }

    // Accessors
    public function getNavbarDisplayNameAttribute()
    {
        return $this->navbar_label ?: $this->getDefaultNavbarLabel();
    }

    public function getNavbarDisplayIconAttribute()
    {
        return $this->navbar_icon ?: $this->getDefaultIcon();
    }

    public function getUsageRangeAttribute()
    {
        if ($this->max_usage) {
            return "{$this->min_usage}-{$this->max_usage} m³";
        }
        return ">{$this->min_usage} m³";
    }

    private function getDefaultNavbarLabel()
    {
        $range = $this->usage_range;
        return "{$this->customer_type} ({$range})";
    }

    private function getDefaultIcon()
    {
        return match(strtolower($this->customer_type)) {
            'rumah tangga', 'domestik' => 'fas fa-home',
            'komersial', 'usaha' => 'fas fa-store',
            'industri' => 'fas fa-industry',
            'sosial' => 'fas fa-heart',
            'instansi' => 'fas fa-building',
            default => 'fas fa-tint'
        };
    }

    // Helper methods
    public function calculateBill($usage)
    {
        $waterCost = $usage * $this->rate_per_m3;
        $totalBill = $waterCost + $this->admin_fee + $this->maintenance_fee;

        return [
            'usage' => $usage,
            'rate' => $this->rate_per_m3,
            'water_cost' => $waterCost,
            'admin_fee' => $this->admin_fee,
            'maintenance_fee' => $this->maintenance_fee,
            'total' => $totalBill
        ];
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'customer_type', 'description', 'min_usage', 'max_usage', 
                'rate_per_m3', 'admin_fee', 'maintenance_fee', 'is_active', 'effective_date'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $type = $this->getAttribute('customer_type') ?? 'Unknown';
                return "Tarif air '{$type}' {$eventName}";
            });
    }
}
