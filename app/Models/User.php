<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, HasName
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'full_name',
        'phone_number',
        'national_id',
        'email',
        'password',
        'family_id',
        'pending_family_name',
        'workplace',
        'current_job',
        'city',
        'region',
        'bio',
        'gender',
        'role',
        'status',
        'social_links',
        'is_featured',
        'approved_by',
        'approved_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'social_links' => 'array',
            'is_featured' => 'boolean',
            'approved_at' => 'datetime',
            'gender' => Gender::class,
            'role' => UserRole::class,
            'status' => UserStatus::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')->singleFile();
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

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function sons(): HasMany
    {
        return $this->hasMany(MemberSon::class)->orderBy('sort_order');
    }

    public function daughters(): HasMany
    {
        return $this->hasMany(MemberDaughter::class)->orderBy('sort_order');
    }

    public function familyRequests(): HasMany
    {
        return $this->hasMany(FamilyRequest::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'offered_by');
    }

    public function devices(): HasMany
    {
        return $this->hasMany(UserDevice::class);
    }

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class, 'submitted_by');
    }

    public function fundTransactions(): HasMany
    {
        return $this->hasMany(FamilyFundTransaction::class, 'contributor_id');
    }

    public function getFilamentName(): string
    {
        if (filled($this->full_name)) {
            return $this->full_name;
        }

        if (filled($this->email)) {
            return $this->email;
        }

        if (filled($this->phone_number)) {
            return $this->phone_number;
        }

        return 'User';
    }
}
