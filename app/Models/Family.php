<?php

namespace App\Models;

use App\Support\FamilyNameNormalizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'origin',
        'normalized_name',
    ];

    protected static function booted(): void
    {
        static::saving(function (Family $family) {
            $family->normalized_name = FamilyNameNormalizer::normalize($family->name);
        });
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
