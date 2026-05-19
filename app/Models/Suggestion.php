<?php

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'suggestion',
        'submitted_by',
        'status',
        'admin_response',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $attributes = [
        'status' => 'under_review',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'status' => SuggestionStatus::class,
        ];
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
