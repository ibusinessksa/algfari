<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => [
                'ar' => $this->getTranslation('question', 'ar'),
                'en' => $this->getTranslation('question', 'en'),
            ],
            'answer' => [
                'ar' => $this->getTranslation('answer', 'ar'),
                'en' => $this->getTranslation('answer', 'en'),
            ],
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
