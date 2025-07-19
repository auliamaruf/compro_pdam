<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Branch extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'branch_type',
        'code',
        'address',
        'phone',
        'email',
        'google_maps_url',
        'head_of_branch_id',
        'office_hours_weekday',
        'office_hours_friday',
        'office_hours_saturday',
        'office_hours_sunday',
        'description',
        'services',
        'coverage_areas',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'services' => 'array',
        'coverage_areas' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Relationship dengan OrganizationStructure untuk kepala cabang
     */
    public function headOfBranch()
    {
        return $this->belongsTo(OrganizationStructure::class, 'head_of_branch_id');
    }

    /**
     * Scope untuk cabang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk cabang saja
     */
    public function scopeCabang($query)
    {
        return $query->where('branch_type', 'cabang');
    }

    /**
     * Scope untuk unit IKK saja
     */
    public function scopeUnitIkk($query)
    {
        return $query->where('branch_type', 'unit_ikk');
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get formatted address
     */
    public function getFormattedAddressAttribute()
    {
        return $this->address;
    }

    /**
     * Get Google Maps URL
     */
    public function getGoogleMapsUrlAttribute()
    {
        return $this->attributes['google_maps_url'] ?? null;
    }

    /**
     * Get formatted office hours
     */
    public function getFormattedOfficeHoursAttribute()
    {
        $hours = [];
        
        if ($this->office_hours_weekday) {
            $hours['Senin - Kamis'] = $this->office_hours_weekday;
        }
        
        if ($this->office_hours_friday) {
            $hours['Jumat'] = $this->office_hours_friday;
        }
        
        if ($this->office_hours_saturday) {
            $hours['Sabtu'] = $this->office_hours_saturday;
        }
        
        if ($this->office_hours_sunday) {
            $hours['Minggu'] = $this->office_hours_sunday;
        }
        
        return $hours;
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name', 'branch_type', 'code', 'address', 'phone', 'email', 
                'office_hours_weekday', 'office_hours_friday', 'office_hours_saturday', 'office_hours_sunday',
                'head_name', 'head_title', 'is_active'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $name = $this->getAttribute('name') ?? 'Unknown';
                return "Cabang '{$name}' {$eventName}";
            });
    }
}
