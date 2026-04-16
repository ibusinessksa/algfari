<?php

namespace App\Models;

use App\Enums\FamilyRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyRequest extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'status',
        'reviewed_by',
        'reviewed_at',
        'rejection_reason',
        'resolved_family_id',
    ];

    protected function casts(): array
    {
        return [
            'status' => FamilyRequestStatus::class,
            'reviewed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function resolvedFamily(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'resolved_family_id');
    }
}
