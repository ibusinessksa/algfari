<?php

namespace App\Http\Resources\Api\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => [
                'ar' => $this->getTranslation('title', 'ar'),
                'en' => $this->getTranslation('title', 'en'),
            ],
            'content' => [
                'ar' => $this->getTranslation('content', 'ar'),
                'en' => $this->getTranslation('content', 'en'),
            ],
            'is_urgent' => $this->is_urgent,
            'cover_image' => $this->getFirstMediaUrl('cover_image'),
            'cover_image_medium' => $this->getFirstMediaUrl('cover_image', 'medium'),
            'cover_image_thumb' => $this->getFirstMediaUrl('cover_image', 'thumb'),
            'gallery' => $this->getMedia('gallery')->map(fn ($m) => [
                'url' => $m->getUrl(),
                'medium' => $m->getUrl('medium'),
                'thumb' => $m->getUrl('thumb'),
            ]),
            'published_at' => $this->published_at?->toISOString(),
            'time_from' => $this->formatTimeForApi($this->time_from),
            'time_to' => $this->formatTimeForApi($this->time_to),
            'created_at' => $this->created_at->toISOString(),
        ];
    }

    private function formatTimeForApi(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }
        if ($value instanceof \DateTimeInterface) {
            return $value->format('H:i:s');
        }
        if (is_string($value)) {
            return Carbon::parse($value)->format('H:i:s');
        }

        return null;
    }
}
