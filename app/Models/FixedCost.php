<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedCost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_name',
        'description',
        'legal_basis',
        'monthly_cost',
        'installation_cost',
        'security_deposit',
        'minimum_usage',
        'meter_size',
        'connection_type',
        'is_active',
        'effective_date',
        'notes'
    ];

    protected $casts = [
        'monthly_cost' => 'decimal:2',
        'installation_cost' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'minimum_usage' => 'integer',
        'is_active' => 'boolean',
        'effective_date' => 'date'
    ];

    /**
     * Scope untuk biaya tetap yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan kategori
     */
    public function scopeOrderedByCategory($query)
    {
        return $query->orderBy('category_name');
    }

    /**
     * Format monthly cost untuk display
     */
    public function getFormattedMonthlyCostAttribute()
    {
        return 'Rp ' . number_format((float) $this->monthly_cost, 0, ',', '.');
    }

    /**
     * Format installation cost untuk display
     */
    public function getFormattedInstallationCostAttribute()
    {
        return 'Rp ' . number_format((float) $this->installation_cost, 0, ',', '.');
    }

    /**
     * Format security deposit untuk display
     */
    public function getFormattedSecurityDepositAttribute()
    {
        return 'Rp ' . number_format((float) $this->security_deposit, 0, ',', '.');
    }
}
