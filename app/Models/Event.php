<?php

namespace App\Models;

use App\Enums\EventType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'event_type',
        'event_date',
        'end_date',
        'location_name',
        'location_lat',
        'location_lng',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'end_date' => 'datetime',
            'is_active' => 'boolean',
            'location_lat' => 'decimal:8',
            'location_lng' => 'decimal:8',
            'event_type' => EventType::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->singleFile();
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

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'location_lat',
            'lng' => 'location_lng',
        ];
    }

    public static function getComputedLocation(): string
    {
        return 'location';
    }

    public function getLocationAttribute(): array
    {
        return [
            'lat' => $this->location_lat !== null ? (float) $this->location_lat : null,
            'lng' => $this->location_lng !== null ? (float) $this->location_lng : null,
        ];
    }

    public function setLocationAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['location_lat'] = $location['lat'] ?? null;
            $this->attributes['location_lng'] = $location['lng'] ?? null;
        }
    }

    public static function getLocationCasts(): array
    {
        return [
            'location' => 'array',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(EventAttendee::class);
    }
}
