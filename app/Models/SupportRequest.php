<?php

namespace App\Models;

use App\Enums\SupportRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SupportRequest extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'amount_requested',
        'amount_granted',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    protected function casts(): array
    {
        return [
            'amount_requested' => 'decimal:2',
            'amount_granted' => 'decimal:2',
            'reviewed_at' => 'datetime',
            'status' => SupportRequestStatus::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
