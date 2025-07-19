<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ContactMessage extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'type',
        'message',
        'is_read',
        'is_resolved',
        'admin_notes',
        'resolved_at',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_resolved' => 'boolean',
        'resolved_at' => 'datetime',
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeUnresolved($query)
    {
        return $query->where('is_resolved', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getTypeDisplayAttribute()
    {
        return match($this->type) {
            'general' => 'Umum',
            'complaint' => 'Keluhan',
            'suggestion' => 'Saran',
            'service_info' => 'Info Layanan',
            'technical_support' => 'Bantuan Teknis',
            default => 'Umum'
        };
    }

    // Mutators
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function markAsResolved($notes = null)
    {
        $this->update([
            'is_resolved' => true,
            'resolved_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'phone', 'subject', 'type', 'message', 'is_read', 'is_resolved', 'admin_notes'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $name = $this->getAttribute('name') ?? 'Unknown';
                return "Pesan kontak dari '{$name}' {$eventName}";
            });
    }
}
