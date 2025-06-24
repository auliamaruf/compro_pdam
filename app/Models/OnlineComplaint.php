<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class OnlineComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'customer_name',
        'customer_id_number',
        'email',
        'phone',
        'address',
        'complaint_type',
        'subject',
        'description',
        'priority',
        'status',
        'attachments',
        'admin_response',
        'responded_at',
        'resolved_at',
        'assigned_to',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'attachments' => 'array',
        'responded_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    // Auto-generate ticket number on creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (empty($complaint->ticket_number)) {
                $complaint->ticket_number = self::generateTicketNumber();
            }
        });
    }

    // Generate unique ticket number
    public static function generateTicketNumber()
    {
        do {
            $ticketNumber = 'TP' . date('Ymd') . Str::upper(Str::random(4));
        } while (self::where('ticket_number', $ticketNumber)->exists());

        return $ticketNumber;
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('complaint_type', $type);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress']);
    }

    public function scopeResolved($query)
    {
        return $query->whereIn('status', ['resolved', 'closed']);
    }

    // Accessors
    public function getComplaintTypeDisplayAttribute()
    {
        return match($this->complaint_type) {
            'billing' => 'Tagihan',
            'water_quality' => 'Kualitas Air',
            'water_pressure' => 'Tekanan Air',
            'service_connection' => 'Sambungan Baru',
            'pipe_damage' => 'Kerusakan Pipa',
            'meter_reading' => 'Pembacaan Meter',
            'other' => 'Lainnya',
            default => 'Tidak Diketahui'
        };
    }

    public function getPriorityDisplayAttribute()
    {
        return match($this->priority) {
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi',
            'urgent' => 'Mendesak',
            default => 'Sedang'
        };
    }

    public function getStatusDisplayAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending',
            'in_progress' => 'Sedang Diproses',
            'resolved' => 'Selesai',
            'closed' => 'Ditutup',
            'cancelled' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }

    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            'urgent' => 'danger',
            default => 'secondary'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'in_progress' => 'primary',
            'resolved' => 'success',
            'closed' => 'secondary',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    // Methods
    public function markAsInProgress($adminId = null)
    {
        $this->update([
            'status' => 'in_progress',
            'assigned_to' => $adminId,
        ]);
    }

    public function markAsResolved($response = null, $adminId = null)
    {
        $this->update([
            'status' => 'resolved',
            'admin_response' => $response,
            'responded_at' => now(),
            'resolved_at' => now(),
            'assigned_to' => $adminId,
        ]);
    }

    public function markAsClosed()
    {
        $this->update([
            'status' => 'closed',
        ]);
    }

    // Relationships
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
