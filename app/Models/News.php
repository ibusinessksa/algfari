<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class News extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['title', 'content'];

    protected $fillable = [
        'title',
        'content',
        'is_urgent',
        'published_at',
        'time_from',
        'time_to',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'json',
            'content' => 'json',
            'is_urgent' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(400)
            ->height(400);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(NewsComment::class);
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(NewsComment::class)->where('status', 'approved');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(NewsReaction::class);
    }
}
