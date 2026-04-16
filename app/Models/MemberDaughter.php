<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberDaughter extends Model
{
    /** @use HasFactory<\Database\Factories\MemberDaughterFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'linked_user_id',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linkedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'linked_user_id');
    }

    public function displayName(): string
    {
        if ($this->relationLoaded('linkedUser') && $this->linkedUser !== null) {
            return (string) $this->linkedUser->full_name;
        }

        return (string) ($this->name ?? '');
    }
}
