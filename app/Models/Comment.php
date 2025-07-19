<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Comment extends Model
{
    use LogsActivity;
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'author_name',
        'author_email',
        'author_phone',
        'content',
        'status',
        'parent_id',
        'meta',
        'approved_at'
    ];

    protected $casts = [
        'meta' => 'array',
        'approved_at' => 'datetime'
    ];

    // Relationships
    public function commentable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')
                   ->where('status', 'approved')
                   ->orderBy('created_at', 'asc');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Helper methods
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function approve()
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);
    }

    public function reject()
    {
        $this->update(['status' => 'rejected']);
    }

    /**
     * Get the options for the activity log.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['author_name', 'author_email', 'content', 'status', 'is_approved'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $author = $this->getAttribute('author_name') ?? 'Unknown';
                return "Komentar dari '{$author}' {$eventName}";
            });
    }
}
