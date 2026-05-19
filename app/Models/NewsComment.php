<?php

namespace App\Models;

use App\Enums\NewsCommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'news_id',
        'user_id',
        'content',
        'status',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $attributes = [
        'status' => 'approved',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'status' => NewsCommentStatus::class,
        ];
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
