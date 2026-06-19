<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia, HasName
{
    use HasApiTokens, HasFactory, HasRoles, InteractsWithMedia, Notifiable, SoftDeletes;

    protected $fillable = [
        'full_name',
        'phone_number',
        'national_id',
        'member_card_number',
        'email',
        'password',
        'family_id',
        'pending_family_name',
        'workplace',
        'current_job',
        'city_id',
        'region_id',
        'bio',
        'gender',
        'role',
        'status',
        'social_links',
        'is_featured',
        'job_title',
        'approved_by',
        'approved_at',
        'email_verified_at',
        'rejection_reason',
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
            'email_verified_at' => 'datetime',
            'gender' => Gender::class,
            'role' => UserRole::class,
            'status' => UserStatus::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')->singleFile();
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(MemberChild::class)->with('linkedUser')->orderBy('sort_order');
    }

    public function sons(): HasMany
    {
        return $this->hasMany(MemberChild::class)->where('gender', 'male')->orderBy('sort_order');
    }

    public function daughters(): HasMany
    {
        return $this->hasMany(MemberChild::class)->where('gender', 'female')->orderBy('sort_order');
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

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'user_id', 'favorited_user_id')->withTimestamps();
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'favorited_user_id', 'user_id')->withTimestamps();
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
