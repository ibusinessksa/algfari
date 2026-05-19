<?php

namespace App\Models;

use App\Enums\FundInitiativeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class FundInitiative extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'raised_amount',
        'status',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'json',
            'description' => 'json',
            'is_active' => 'boolean',
            'target_amount' => 'decimal:2',
            'raised_amount' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => FundInitiativeStatus::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->singleFile();
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(150)->height(150)->sharpen(10);
        $this->addMediaConversion('medium')->width(400)->height(400);
    }
}
