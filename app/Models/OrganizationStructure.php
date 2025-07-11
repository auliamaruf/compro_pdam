<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationStructure extends Model
{
    use HasFactory;

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
}
