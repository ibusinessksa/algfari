<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Broadcast extends Model
{
    protected $fillable = [
        'title',
        'body',
        'audience_type',
        'audience_filter',
        'channels',
        'recipients_count',
        'sent_at',
        'sent_by',
    ];

    protected function casts(): array
    {
        return [
            'audience_filter' => 'array',
            'channels' => 'array',
            'sent_at' => 'datetime',
        ];
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
