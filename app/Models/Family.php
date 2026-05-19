<?php

namespace App\Models;

use App\Support\FamilyNameNormalizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'origin',
        'normalized_name',
        'parent_family_id',
        'generation',
    ];

    protected static function booted(): void
    {
        static::saving(function (Family $family) {
            $family->normalized_name = FamilyNameNormalizer::normalize($family->name);

            if ($family->parent_family_id) {
                $parent = self::find($family->parent_family_id);
                $family->generation = ($parent?->generation ?? 0) + 1;
            } elseif (! $family->exists) {
                $family->generation = $family->generation ?: 1;
            }
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'parent_family_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Family::class, 'parent_family_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function resolvedFamilyRequests(): HasMany
    {
        return $this->hasMany(FamilyRequest::class, 'resolved_family_id');
    }
}
