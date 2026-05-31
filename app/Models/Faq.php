<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = ['question', 'answer'];

    protected $fillable = ['question', 'answer', 'is_active'];

    protected function casts(): array
    {
        return [
            'question' => 'json',
            'answer' => 'json',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->where('is_active', true);
    }
}
