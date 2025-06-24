<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'target',
        'icon',
        'parent_id',
        'sort_order',
        'is_active',
        'is_external',
        'description',
        'position'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_external' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeMainMenu($query)
    {
        return $query->where('position', 'main')->whereNull('parent_id');
    }

    public function scopeFooterMenu($query)
    {
        return $query->where('position', 'footer');
    }

    public function getIsParentAttribute()
    {
        return $this->children()->exists();
    }
}
