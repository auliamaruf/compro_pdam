<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_active',
        'published_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_date' => 'date',
    ];
}
