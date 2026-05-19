<?php

namespace App\Models;

use App\Enums\OfferCategory;
use App\Enums\OfferPartnerType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Offer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'category',
        'partner_type',
        'partner_name',
        'service_address',
        'region_id',
        'contact_phone',
        'contact_whatsapp',
        'is_active',
        'is_featured',
        'offered_by',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'json',
            'description' => 'json',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'expires_at' => 'datetime',
            'category' => OfferCategory::class,
            'partner_type' => OfferPartnerType::class,
        ];
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Region::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('offer_image')->singleFile();
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

    public function offeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'offered_by');
    }
}
