<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'branch_type',
        'code',
        'address',
        'phone',
        'email',
        'latitude',
        'longitude',
        'head_of_branch_id',
        'office_hours',
        'description',
        'services',
        'coverage_areas',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'office_hours' => 'array',
        'services' => 'array',
        'coverage_areas' => 'array',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
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
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps?q=" . $this->latitude . "," . $this->longitude;
        }
        return "https://www.google.com/maps/search/" . urlencode($this->address);
    }
}
