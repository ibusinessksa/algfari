# 🏗️ خطة تنفيذ مشروع إدارة الأسرة / القبيلة — Laravel + Filament

> **المنصة:** Laravel 12 + Filament v3 + Spatie Media Library
> **قاعدة البيانات:** MySQL / PostgreSQL
> **الإصدار:** 1.0
> **التاريخ:** أبريل 2026

---

## 📋 فهرس الخطة

| الرقم | المرحلة | المدة التقديرية |
|-------|---------|-----------------|
| 1 | تهيئة المشروع وتثبيت الحزم | يوم 1-2 |
| 2 | إعداد قاعدة البيانات (Migrations & Models) | يوم 3-5 |
| 3 | نظام المصادقة و API Authentication | يوم 6-8 |
| 4 | بناء الـ API Endpoints | يوم 9-14 |
| 5 | لوحة التحكم Filament | يوم 15-20 |
| 6 | نظام الإشعارات | يوم 21-22 |
| 7 | نظام الوسائط (Spatie Media Library) | يوم 23-24 |
| 8 | التعدد اللغوي (Localization) | يوم 25-26 |
| 9 | الاختبارات | يوم 27-29 |
| 10 | استخراج ملف Postman Collection | يوم 30 |
| 11 | النشر والتوثيق النهائي | يوم 31-33 |

---

## المرحلة 1: تهيئة المشروع وتثبيت الحزم (يوم 1-2)

### 1.1 تثبيت الحزم المطلوبة

```bash
# Filament Admin Panel
composer require filament/filament:"^3.3"
php artisan filament:install --panels

# Spatie Media Library (بديل أعمدة الصور والملفات)
composer require spatie/laravel-medialibrary:"^11.0"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"

# Sanctum (API Authentication)
composer require laravel/sanctum
php artisan install:api

# Spatie Laravel Translatable (JSONB multilingual)
composer require spatie/laravel-translatable

# Spatie Laravel Permission (Roles & Permissions)
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Filament Spatie Media Library Plugin
composer require filament/spatie-laravel-media-library-plugin:"^3.3"

# Filament Spatie Translatable Plugin
composer require filament/spatie-laravel-translatable-plugin:"^3.3"

# API Documentation / Postman Export
composer require --dev knuckleswtf/scribe
```

### 1.2 إعداد ملف `.env`

```env
APP_NAME="Family Tribe App"
APP_URL=http://localhost:8000
APP_LOCALE=ar
APP_FALLBACK_LOCALE=ar
APP_AVAILABLE_LOCALES=ar,en

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=family_tribe_app
DB_USERNAME=postgres
DB_PASSWORD=secret

FILESYSTEM_DISK=public

# SMS/OTP Provider
OTP_DRIVER=twilio
TWILIO_SID=xxx
TWILIO_TOKEN=xxx
TWILIO_FROM=xxx
```

### 1.3 هيكل المجلدات

```
app/
├── Enums/                    # جميع الـ Enums
│   ├── Gender.php
│   ├── UserRole.php
│   ├── UserStatus.php
│   ├── EventType.php
│   ├── OfferCategory.php
│   ├── TransactionType.php
│   ├── TransactionStatus.php
│   ├── RequestType.php
│   ├── SupportStatus.php
│   ├── SupportPriority.php
│   ├── JoinRequestStatus.php
│   ├── OtpPurpose.php
│   ├── RsvpStatus.php
│   ├── NewsCategory.php
│   └── SuggestionStatus.php
├── Models/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── V1/           # API v1 Controllers
│   ├── Requests/
│   │   └── Api/
│   │       └── V1/           # Form Requests
│   └── Resources/
│       └── Api/
│           └── V1/           # API Resources (Transformers)
├── Services/                 # Business Logic
│   ├── OtpService.php
│   ├── JoinRequestService.php
│   └── FundService.php
├── Notifications/            # Laravel Notifications
├── Policies/                 # Authorization Policies
└── Filament/
    ├── Resources/            # Filament CRUD Resources
    ├── Pages/                # Custom Pages
    └── Widgets/              # Dashboard Widgets
```

### 1.4 إنشاء المستخدم الإداري لـ Filament

```bash
php artisan make:filament-user
```

---

## المرحلة 2: إعداد قاعدة البيانات — Migrations & Models (يوم 3-5)

### ⚠️ ملاحظات مهمة قبل البدء

- **لا يوجد أعمدة صور أو ملفات** في أي جدول — جميع الوسائط تُدار عبر `Spatie Media Library` وتُخزن في جدول `media` الخاص بها.
- **لا يوجد جدول notifications مخصص** — نستخدم جدول `notifications` الافتراضي في Laravel.
- **الحقول النصية القابلة للترجمة** تكون من نوع `JSON` وتُدار عبر `Spatie Translatable`.

### 2.1 Migration: `users`

```bash
php artisan make:migration create_users_table
```

```php
Schema::create('users', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('full_name');
    $table->string('phone_number', 20)->unique();
    $table->string('national_id', 20)->nullable()->unique();
    $table->string('email')->nullable()->unique();
    $table->string('password');
    $table->string('sub_tribe', 100)->nullable();
    $table->string('city', 100)->nullable();
    $table->string('region', 100)->nullable();
    $table->text('bio')->nullable();
    $table->string('gender');              // Enum: male, female
    $table->string('role')->default('member');  // Enum: admin, member
    $table->string('status')->default('pending'); // Enum: active, pending, rejected
    $table->json('social_links')->nullable();
    $table->boolean('is_featured')->default(false);
    $table->uuid('approved_by')->nullable();
    $table->timestamp('approved_at')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
});
```

**Model: `User.php`**

```php
<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable, SoftDeletes, InteractsWithMedia;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'full_name', 'phone_number', 'national_id', 'email', 'password',
        'sub_tribe', 'city', 'region', 'bio', 'gender', 'role', 'status',
        'social_links', 'is_featured', 'approved_by', 'approved_at',
    ];

    protected $hidden = ['password', 'remember_token'];

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

    // ── Media Collections ──
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')->singleFile();
    }

    // ── Relations ──
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'offered_by');
    }

    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }
}
```

### 2.2 Migration: `otp_codes`

```bash
php artisan make:migration create_otp_codes_table
```

```php
Schema::create('otp_codes', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('user_id')->nullable();
    $table->string('phone_number', 20);
    $table->string('code', 6);
    $table->string('purpose');        // Enum: register, reset, verify
    $table->boolean('is_used')->default(false);
    $table->timestamp('expires_at');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
    $table->index(['phone_number', 'code', 'purpose']);
});
```

**Model: `OtpCode.php`**

```php
<?php

namespace App\Models;

use App\Enums\OtpPurpose;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'phone_number', 'code', 'purpose', 'is_used', 'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'is_used' => 'boolean',
            'expires_at' => 'datetime',
            'purpose' => OtpPurpose::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }
}
```

### 2.3 Migration: `join_requests`

```php
Schema::create('join_requests', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('user_id')->nullable();
    $table->string('full_name');
    $table->string('phone_number', 20);
    $table->string('national_id', 20)->nullable();
    $table->string('email')->nullable();
    $table->string('sub_tribe', 100)->nullable();
    $table->string('city', 100)->nullable();
    $table->string('region', 100)->nullable();
    $table->string('status')->default('pending'); // Enum: pending, approved, rejected
    $table->uuid('reviewed_by')->nullable();
    $table->timestamp('reviewed_at')->nullable();
    $table->text('rejection_reason')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
    $table->foreign('reviewed_by')->references('id')->on('users')->nullOnDelete();
});
```

**Model: `JoinRequest.php`**
```php
<?php

namespace App\Models;

use App\Enums\JoinRequestStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class JoinRequest extends Model implements HasMedia
{
    use HasUuids, InteractsWithMedia;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'full_name', 'phone_number', 'national_id', 'email',
        'sub_tribe', 'city', 'region', 'status', 'reviewed_by',
        'reviewed_at', 'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'status' => JoinRequestStatus::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')->singleFile();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
```

### 2.4 Migration: `news`

```php
Schema::create('news', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->json('title');               // {"ar": "...", "en": "..."}
    $table->json('content');             // {"ar": "...", "en": "..."}
    $table->json('summary')->nullable(); // {"ar": "...", "en": "..."}
    $table->string('category');          // Enum: family, general
    $table->boolean('is_pinned')->default(false);
    $table->unsignedInteger('views_count')->default(0);
    $table->uuid('author_id');
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete();
});
```

**Model: `News.php`**

```php
<?php

namespace App\Models;

use App\Enums\NewsCategory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class News extends Model implements HasMedia
{
    use HasUuids, SoftDeletes, InteractsWithMedia, HasTranslations;

    protected $keyType = 'string';
    public $incrementing = false;

    public array $translatable = ['title', 'content', 'summary'];

    protected $fillable = [
        'title', 'content', 'summary', 'category', 'is_pinned',
        'views_count', 'author_id', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_pinned' => 'boolean',
            'published_at' => 'datetime',
            'category' => NewsCategory::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
```

### 2.5 Migration: `events`

```php
Schema::create('events', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->json('title');                // {"ar": "...", "en": "..."}
    $table->json('description')->nullable();
    $table->string('event_type');         // Enum: wedding, death, other
    $table->timestamp('event_date');
    $table->timestamp('end_date')->nullable();
    $table->string('location_name')->nullable();
    $table->decimal('location_lat', 10, 8)->nullable();
    $table->decimal('location_lng', 11, 8)->nullable();
    $table->boolean('is_active')->default(true);
    $table->uuid('created_by');
    $table->timestamps();
    $table->softDeletes();

    $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
});
```

**Model: `Event.php`**

```php
<?php

namespace App\Models;

use App\Enums\EventType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Event extends Model implements HasMedia
{
    use HasUuids, SoftDeletes, InteractsWithMedia, HasTranslations;

    protected $keyType = 'string';
    public $incrementing = false;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title', 'description', 'event_type', 'event_date', 'end_date',
        'location_name', 'location_lat', 'location_lng', 'is_active', 'created_by',
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees()
    {
        return $this->hasMany(EventAttendee::class);
    }
}
```

### 2.6 Migration: `event_attendees`

```php
Schema::create('event_attendees', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('event_id');
    $table->uuid('user_id');
    $table->string('rsvp_status')->default('going'); // Enum: going, maybe, declined
    $table->timestamps();

    $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete();
    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
    $table->unique(['event_id', 'user_id']);
});
```

### 2.7 Migration: `offers`

```php
Schema::create('offers', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->json('title');                // {"ar": "...", "en": "..."}
    $table->json('description')->nullable();
    $table->string('category');           // Enum: commercial, contractor
    $table->string('service_address')->nullable();
    $table->string('contact_phone', 20)->nullable();
    $table->string('contact_whatsapp', 20)->nullable();
    $table->boolean('is_active')->default(true);
    $table->uuid('offered_by');
    $table->timestamp('expires_at')->nullable();
    $table->timestamps();
    $table->softDeletes();

    $table->foreign('offered_by')->references('id')->on('users')->cascadeOnDelete();
});
```

**Model: `Offer.php`**

```php
<?php

namespace App\Models;

use App\Enums\OfferCategory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Offer extends Model implements HasMedia
{
    use HasUuids, SoftDeletes, InteractsWithMedia, HasTranslations;

    protected $keyType = 'string';
    public $incrementing = false;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title', 'description', 'category', 'service_address',
        'contact_phone', 'contact_whatsapp', 'is_active', 'offered_by', 'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'expires_at' => 'datetime',
            'category' => OfferCategory::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('offer_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function offeredBy()
    {
        return $this->belongsTo(User::class, 'offered_by');
    }
}
```

### 2.8 Migration: `family_fund_transactions`

```php
Schema::create('family_fund_transactions', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('contributor_id');
    $table->decimal('amount', 12, 2);
    $table->string('transaction_type');     // Enum: donation, expense
    $table->json('description')->nullable(); // {"ar": "...", "en": "..."}
    $table->uuid('approved_by')->nullable();
    $table->timestamp('approved_at')->nullable();
    $table->string('status')->default('pending'); // Enum: pending, approved, rejected
    $table->timestamps();

    $table->foreign('contributor_id')->references('id')->on('users')->cascadeOnDelete();
    $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
});
```

**Model: `FamilyFundTransaction.php`**

```php
<?php

namespace App\Models;

use App\Enums\TransactionType;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class FamilyFundTransaction extends Model implements HasMedia
{
    use HasUuids, InteractsWithMedia, HasTranslations;

    protected $keyType = 'string';
    public $incrementing = false;

    public array $translatable = ['description'];

    protected $fillable = [
        'contributor_id', 'amount', 'transaction_type', 'description',
        'approved_by', 'approved_at', 'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'approved_at' => 'datetime',
            'transaction_type' => TransactionType::class,
            'status' => TransactionStatus::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('receipt')->singleFile();
    }

    public function contributor()
    {
        return $this->belongsTo(User::class, 'contributor_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
```

### 2.9 Migration: `suggestions`

```php
Schema::create('suggestions', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->json('title');                // {"ar": "...", "en": "..."}
    $table->json('description');          // {"ar": "...", "en": "..."}
    $table->uuid('submitted_by');
    $table->string('status')->default('pending'); // Enum: pending, reviewed
    $table->text('admin_response')->nullable();
    $table->uuid('reviewed_by')->nullable();
    $table->timestamp('reviewed_at')->nullable();
    $table->timestamps();

    $table->foreign('submitted_by')->references('id')->on('users')->cascadeOnDelete();
    $table->foreign('reviewed_by')->references('id')->on('users')->nullOnDelete();
});
```

**Model: `Suggestion.php`**

```php
<?php

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Suggestion extends Model
{
    use HasUuids, HasTranslations;

    protected $keyType = 'string';
    public $incrementing = false;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title', 'description', 'submitted_by', 'status',
        'admin_response', 'reviewed_by', 'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'status' => SuggestionStatus::class,
        ];
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
```

### 2.10 Migration: `support_requests`

```php
Schema::create('support_requests', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('request_type');         // Enum: technical, general, complaint
    $table->json('subject');                // {"ar": "...", "en": "..."}
    $table->json('description');            // {"ar": "...", "en": "..."}
    $table->uuid('submitted_by');
    $table->string('status')->default('open'); // Enum: open, in_progress, resolved
    $table->string('priority')->default('medium'); // Enum: low, medium, high
    $table->uuid('assigned_to')->nullable();
    $table->timestamp('resolved_at')->nullable();
    $table->timestamps();

    $table->foreign('submitted_by')->references('id')->on('users')->cascadeOnDelete();
    $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();
});
```

**Model: `SupportRequest.php`**

```php
<?php

namespace App\Models;

use App\Enums\RequestType;
use App\Enums\SupportStatus;
use App\Enums\SupportPriority;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SupportRequest extends Model
{
    use HasUuids, HasTranslations;

    protected $keyType = 'string';
    public $incrementing = false;

    public array $translatable = ['subject', 'description'];

    protected $fillable = [
        'request_type', 'subject', 'description', 'submitted_by',
        'status', 'priority', 'assigned_to', 'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
            'request_type' => RequestType::class,
            'status' => SupportStatus::class,
            'priority' => SupportPriority::class,
        ];
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
```

### 2.11 Migration: `user_devices`

```php
Schema::create('user_devices', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('user_id');
    $table->text('device_token');
    $table->string('platform');           // Enum: ios, android
    $table->boolean('is_active')->default(true);
    $table->timestamp('last_used_at')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
});
```

### 2.12 Migration: `activity_logs`

```php
Schema::create('activity_logs', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('user_id')->nullable();
    $table->string('action', 100);
    $table->string('entity_type', 50);
    $table->uuid('entity_id')->nullable();
    $table->json('metadata')->nullable();
    $table->string('ip_address', 45)->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
    $table->index(['entity_type', 'entity_id']);
});
```

### 2.13 إنشاء جدول الإشعارات الافتراضي

```bash
php artisan notifications:table
php artisan migrate
```

> يُنشئ جدول `notifications` الافتراضي في Laravel بأعمدة: `id`, `type`, `notifiable_type`, `notifiable_id`, `data` (JSON), `read_at`, `created_at`, `updated_at`.

### 2.14 إنشاء الـ Enums

```bash
mkdir -p app/Enums
```

**مثال: `app/Enums/UserRole.php`**

```php
<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Member = 'member';

    public function label(): string
    {
        return match($this) {
            self::Admin => __('enums.role.admin'),
            self::Member => __('enums.role.member'),
        };
    }
}
```

> يتم إنشاء Enum لكل من: `Gender`, `UserRole`, `UserStatus`, `EventType`, `OfferCategory`, `TransactionType`, `TransactionStatus`, `RequestType`, `SupportStatus`, `SupportPriority`, `JoinRequestStatus`, `OtpPurpose`, `RsvpStatus`, `NewsCategory`, `SuggestionStatus`

### 2.15 تشغيل الـ Migrations

```bash
php artisan migrate
```

### 2.16 إنشاء Seeders

```bash
php artisan make:seeder UserSeeder
php artisan make:seeder NewsSeeder
php artisan make:seeder EventSeeder
php artisan make:seeder OfferSeeder
```

---

## المرحلة 3: نظام المصادقة و API Authentication (يوم 6-8)

### 3.1 إعداد Routes

**`routes/api.php`**

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\OfferController;
use App\Http\Controllers\Api\V1\FundController;
use App\Http\Controllers\Api\V1\SuggestionController;
use App\Http\Controllers\Api\V1\SupportController;
use App\Http\Controllers\Api\V1\NotificationController;

Route::prefix('v1')->group(function () {

    // ── Public (Auth) ──
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('send-otp', [AuthController::class, 'sendOtp']);
        Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
        Route::post('join-request', [AuthController::class, 'joinRequest']);
        Route::post('reset-password', [AuthController::class, 'resetPassword']);
        Route::put('change-password', [AuthController::class, 'changePassword'])
             ->middleware('auth:sanctum');
        Route::post('logout', [AuthController::class, 'logout'])
             ->middleware('auth:sanctum');
    });

    // ── Protected ──
    Route::middleware('auth:sanctum')->group(function () {

        // Members
        Route::apiResource('members', MemberController::class)->only(['index', 'show', 'update']);
        Route::get('members/{member}/card', [MemberController::class, 'card']);

        // News
        Route::apiResource('news', NewsController::class)->only(['index', 'show']);

        // Events
        Route::apiResource('events', EventController::class)->only(['index', 'show']);
        Route::post('events/{event}/rsvp', [EventController::class, 'rsvp']);

        // Offers
        Route::apiResource('offers', OfferController::class)->only(['index', 'show']);

        // Family Fund
        Route::get('fund', [FundController::class, 'index']);
        Route::get('fund/summary', [FundController::class, 'summary']);

        // Suggestions
        Route::post('suggestions', [SuggestionController::class, 'store']);

        // Support
        Route::post('support', [SupportController::class, 'store']);

        // Notifications
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::put('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::put('notifications/read-all', [NotificationController::class, 'markAllAsRead']);

        // Device registration
        Route::post('devices', [MemberController::class, 'registerDevice']);
    });
});
```

### 3.2 Middleware للغة

**`app/Http/Middleware/SetLocale.php`**

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language', 'ar');
        $locale = in_array($locale, ['ar', 'en']) ? $locale : 'ar';
        app()->setLocale($locale);

        return $next($request);
    }
}
```

> يتم تسجيله في `bootstrap/app.php` ضمن `api` middleware group.

### 3.3 AuthController

```bash
php artisan make:controller Api/V1/AuthController
```

```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\OtpCode;
use App\Models\JoinRequest;
use App\Services\OtpService;
use App\Enums\OtpPurpose;
use App\Enums\JoinRequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private OtpService $otpService) {}

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',      // phone or national_id
            'password' => 'required|string',
        ]);

        $user = User::where('phone_number', $request->login)
                     ->orWhere('national_id', $request->login)
                     ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => __('auth.failed')], 401);
        }

        if ($user->status !== \App\Enums\UserStatus::Active) {
            return response()->json(['message' => __('auth.inactive')], 403);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20',
            'purpose' => 'required|string|in:register,reset,verify',
        ]);

        $otp = $this->otpService->generate(
            $request->phone_number,
            OtpPurpose::from($request->purpose)
        );

        // Send via SMS provider
        $this->otpService->send($request->phone_number, $otp->code);

        return response()->json(['message' => __('otp.sent')]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'code' => 'required|string|size:6',
            'purpose' => 'required|string|in:register,reset,verify',
        ]);

        $valid = $this->otpService->verify(
            $request->phone_number,
            $request->code,
            OtpPurpose::from($request->purpose)
        );

        if (!$valid) {
            return response()->json(['message' => __('otp.invalid')], 422);
        }

        return response()->json(['message' => __('otp.verified'), 'verified' => true]);
    }

    public function joinRequest(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'national_id' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'sub_tribe' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'nullable|image|max:5120',
        ]);

        $joinRequest = JoinRequest::create($request->except(['password', 'profile_image', 'password_confirmation']));

        if ($request->hasFile('profile_image')) {
            $joinRequest->addMediaFromRequest('profile_image')
                        ->toMediaCollection('profile_image');
        }

        return response()->json([
            'message' => __('join_request.submitted'),
            'join_request' => $joinRequest,
        ], 201);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'code' => 'required|string|size:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $valid = $this->otpService->verify(
            $request->phone_number,
            $request->code,
            OtpPurpose::Reset
        );

        if (!$valid) {
            return response()->json(['message' => __('otp.invalid')], 422);
        }

        $user = User::where('phone_number', $request->phone_number)->firstOrFail();
        $user->update(['password' => $request->password]);

        return response()->json(['message' => __('password.reset_success')]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => __('password.incorrect')], 422);
        }

        $user->update(['password' => $request->password]);

        return response()->json(['message' => __('password.changed')]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => __('auth.logged_out')]);
    }
}
```

### 3.4 OtpService

```php
<?php

namespace App\Services;

use App\Models\OtpCode;
use App\Enums\OtpPurpose;

class OtpService
{
    public function generate(string $phone, OtpPurpose $purpose, ?string $userId = null): OtpCode
    {
        // Invalidate previous codes
        OtpCode::where('phone_number', $phone)
               ->where('purpose', $purpose)
               ->where('is_used', false)
               ->update(['is_used' => true]);

        return OtpCode::create([
            'user_id' => $userId,
            'phone_number' => $phone,
            'code' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'purpose' => $purpose,
            'expires_at' => now()->addMinutes(5),
        ]);
    }

    public function verify(string $phone, string $code, OtpPurpose $purpose): bool
    {
        $otp = OtpCode::where('phone_number', $phone)
                       ->where('code', $code)
                       ->where('purpose', $purpose)
                       ->where('is_used', false)
                       ->where('expires_at', '>', now())
                       ->first();

        if (!$otp) return false;

        $otp->update(['is_used' => true]);
        return true;
    }

    public function send(string $phone, string $code): void
    {
        // Integration with Twilio / MessageBird
        // TODO: Implement SMS sending
    }
}
```

---

## المرحلة 4: بناء الـ API Endpoints (يوم 9-14)

### 4.1 API Resources (Transformers)

```bash
php artisan make:resource Api/V1/UserResource
php artisan make:resource Api/V1/NewsResource
php artisan make:resource Api/V1/EventResource
php artisan make:resource Api/V1/OfferResource
php artisan make:resource Api/V1/FundTransactionResource
php artisan make:resource Api/V1/MemberCardResource
```

**مثال: `NewsResource.php`**

```php
<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,       // Spatie auto-translates based on locale
            'content' => $this->content,
            'summary' => $this->summary,
            'category' => $this->category,
            'is_pinned' => $this->is_pinned,
            'views_count' => $this->views_count,
            'cover_image' => $this->getFirstMediaUrl('cover_image'),
            'gallery' => $this->getMedia('gallery')->map(fn ($m) => $m->getUrl()),
            'author' => new UserResource($this->whenLoaded('author')),
            'published_at' => $this->published_at?->toISOString(),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
```

### 4.2 Controllers

يتم إنشاء Controller لكل وحدة:

```bash
php artisan make:controller Api/V1/MemberController --api
php artisan make:controller Api/V1/NewsController --api
php artisan make:controller Api/V1/EventController --api
php artisan make:controller Api/V1/OfferController --api
php artisan make:controller Api/V1/FundController
php artisan make:controller Api/V1/SuggestionController
php artisan make:controller Api/V1/SupportController
php artisan make:controller Api/V1/NotificationController
```

### 4.3 Form Requests

```bash
php artisan make:request Api/V1/LoginRequest
php artisan make:request Api/V1/SendOtpRequest
php artisan make:request Api/V1/JoinRequestFormRequest
php artisan make:request Api/V1/StoreNewsRequest
php artisan make:request Api/V1/StoreSuggestionRequest
php artisan make:request Api/V1/StoreSupportRequest
php artisan make:request Api/V1/UpdateMemberRequest
```

### 4.4 جدول الـ Endpoints النهائي

| Method | Endpoint | الوصف | Auth |
|--------|----------|-------|------|
| POST | `/api/v1/auth/login` | تسجيل الدخول | ❌ |
| POST | `/api/v1/auth/send-otp` | إرسال OTP | ❌ |
| POST | `/api/v1/auth/verify-otp` | التحقق من OTP | ❌ |
| POST | `/api/v1/auth/join-request` | طلب انضمام | ❌ |
| POST | `/api/v1/auth/reset-password` | إعادة تعيين كلمة المرور | ❌ |
| PUT | `/api/v1/auth/change-password` | تغيير كلمة المرور | ✅ |
| POST | `/api/v1/auth/logout` | تسجيل الخروج | ✅ |
| GET | `/api/v1/members` | قائمة الأفراد | ✅ |
| GET | `/api/v1/members/{id}` | تفاصيل فرد | ✅ |
| PUT | `/api/v1/members/{id}` | تحديث بيانات فرد | ✅ |
| GET | `/api/v1/members/{id}/card` | البطاقة التعريفية | ✅ |
| GET | `/api/v1/news` | قائمة الأخبار | ✅ |
| GET | `/api/v1/news/{id}` | تفاصيل خبر | ✅ |
| GET | `/api/v1/events` | قائمة المناسبات | ✅ |
| GET | `/api/v1/events/{id}` | تفاصيل مناسبة | ✅ |
| POST | `/api/v1/events/{id}/rsvp` | تسجيل حضور | ✅ |
| GET | `/api/v1/offers` | قائمة العروض | ✅ |
| GET | `/api/v1/offers/{id}` | تفاصيل عرض | ✅ |
| GET | `/api/v1/fund` | معاملات الصندوق | ✅ |
| GET | `/api/v1/fund/summary` | ملخص الصندوق | ✅ |
| POST | `/api/v1/suggestions` | إرسال مقترح | ✅ |
| POST | `/api/v1/support` | إرسال طلب دعم | ✅ |
| GET | `/api/v1/notifications` | الإشعارات | ✅ |
| PUT | `/api/v1/notifications/{id}/read` | تعليم كمقروء | ✅ |
| PUT | `/api/v1/notifications/read-all` | تعليم الكل كمقروء | ✅ |
| POST | `/api/v1/devices` | تسجيل جهاز للإشعارات | ✅ |

---

## المرحلة 5: لوحة التحكم — Filament (يوم 15-20)

### 5.1 إنشاء الـ Resources

```bash
# إنشاء Filament Resources
php artisan make:filament-resource User --generate
php artisan make:filament-resource JoinRequest --generate
php artisan make:filament-resource News --generate
php artisan make:filament-resource Event --generate
php artisan make:filament-resource Offer --generate
php artisan make:filament-resource FamilyFundTransaction --generate
php artisan make:filament-resource Suggestion --generate
php artisan make:filament-resource SupportRequest --generate
```

### 5.2 مثال: NewsResource في Filament

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use App\Enums\NewsCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    use Translatable;

    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'المحتوى';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('بيانات الخبر')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('العنوان')
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('content')
                    ->label('المحتوى')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('summary')
                    ->label('الملخص')
                    ->rows(3),

                Forms\Components\Select::make('category')
                    ->label('التصنيف')
                    ->options(NewsCategory::class)
                    ->required(),

                Forms\Components\Select::make('author_id')
                    ->label('الكاتب')
                    ->relationship('author', 'full_name')
                    ->searchable()
                    ->required(),

                Forms\Components\Toggle::make('is_pinned')
                    ->label('مثبت'),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('تاريخ النشر'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('cover_image')
                    ->label('صورة الغلاف')
                    ->collection('cover_image')
                    ->image(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                    ->label('معرض الصور')
                    ->collection('gallery')
                    ->multiple()
                    ->image(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover_image')
                    ->label('الصورة')
                    ->collection('cover_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('التصنيف')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_pinned')
                    ->label('مثبت')
                    ->boolean(),
                Tables\Columns\TextColumn::make('author.full_name')
                    ->label('الكاتب'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('تاريخ النشر')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(NewsCategory::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
```

### 5.3 Filament Widgets (Dashboard)

```bash
php artisan make:filament-widget StatsOverview --stats-overview
php artisan make:filament-widget LatestJoinRequests --table
php artisan make:filament-widget MembersChart --chart
```

**مثال: `StatsOverview.php`**

```php
<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\News;
use App\Models\Event;
use App\Models\JoinRequest;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي الأفراد', User::where('status', 'active')->count())
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('طلبات الانضمام المعلقة', JoinRequest::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('الأخبار', News::count())
                ->icon('heroicon-o-newspaper')
                ->color('info'),

            Stat::make('المناسبات القادمة', Event::where('event_date', '>', now())->count())
                ->icon('heroicon-o-calendar')
                ->color('primary'),
        ];
    }
}
```

### 5.4 إدارة طلبات الانضمام (Custom Action)

```php
// في JoinRequestResource
Tables\Actions\Action::make('approve')
    ->label('قبول')
    ->icon('heroicon-o-check-circle')
    ->color('success')
    ->requiresConfirmation()
    ->action(function (JoinRequest $record) {
        $record->update([
            'status' => JoinRequestStatus::Approved,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // Create user account
        $user = User::create([
            'full_name' => $record->full_name,
            'phone_number' => $record->phone_number,
            'national_id' => $record->national_id,
            'email' => $record->email,
            'password' => $record->password_hash,
            'sub_tribe' => $record->sub_tribe,
            'city' => $record->city,
            'region' => $record->region,
            'status' => UserStatus::Active,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        // Transfer profile image
        if ($record->hasMedia('profile_image')) {
            $record->getFirstMedia('profile_image')->copy($user, 'profile_image');
        }

        // Send notification
        $user->notify(new JoinRequestApproved());
    })
    ->visible(fn ($record) => $record->status === JoinRequestStatus::Pending),

Tables\Actions\Action::make('reject')
    ->label('رفض')
    ->icon('heroicon-o-x-circle')
    ->color('danger')
    ->form([
        Forms\Components\Textarea::make('rejection_reason')
            ->label('سبب الرفض')
            ->required(),
    ])
    ->action(function (JoinRequest $record, array $data) {
        $record->update([
            'status' => JoinRequestStatus::Rejected,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => $data['rejection_reason'],
        ]);
    })
    ->visible(fn ($record) => $record->status === JoinRequestStatus::Pending),
```

---

## المرحلة 6: نظام الإشعارات (يوم 21-22)

### 6.1 استخدام نظام Laravel Notifications الافتراضي

```bash
php artisan make:notification JoinRequestApproved
php artisan make:notification JoinRequestRejected
php artisan make:notification NewNewsPublished
php artisan make:notification NewEventCreated
php artisan make:notification NewOfferPublished
```

**مثال: `JoinRequestApproved.php`**

```php
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JoinRequestApproved extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['database'];  // يستخدم جدول notifications الافتراضي
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => [
                'ar' => 'تم قبول طلب انضمامك',
                'en' => 'Your join request has been approved',
            ],
            'body' => [
                'ar' => 'مرحبًا بك في العائلة! يمكنك الآن تسجيل الدخول.',
                'en' => 'Welcome to the family! You can now log in.',
            ],
            'type' => 'join_request',
            'action_url' => '/login',
        ];
    }
}
```

### 6.2 NotificationController

```php
public function index(Request $request)
{
    $locale = app()->getLocale();
    $notifications = $request->user()
        ->notifications()
        ->paginate(20);

    $notifications->getCollection()->transform(function ($n) use ($locale) {
        return [
            'id' => $n->id,
            'title' => $n->data['title'][$locale] ?? $n->data['title']['ar'],
            'body' => $n->data['body'][$locale] ?? $n->data['body']['ar'],
            'type' => $n->data['type'] ?? null,
            'is_read' => !is_null($n->read_at),
            'created_at' => $n->created_at->toISOString(),
        ];
    });

    return response()->json($notifications);
}
```

---

## المرحلة 7: نظام الوسائط — Spatie Media Library (يوم 23-24)

### 7.1 الـ Media Collections لكل Model

| المجموعة | النوع | الـ Model |
|----------|------|-----------|
| `profile_image` | صورة واحدة | User |
| `profile_image` | صورة واحدة | JoinRequest |
| `cover_image` | صورة واحدة | News |
| `gallery` | صور متعددة | News |
| `cover_image` | صورة واحدة | Event |
| `offer_image` | صورة واحدة | Offer |
| `gallery` | صور متعددة | Offer |
| `receipt` | ملف واحد | FamilyFundTransaction |

### 7.2 Conversions (أحجام مختلفة)

```php
// في كل Model يحتاج conversions
public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
         ->width(150)
         ->height(150)
         ->sharpen(10);

    $this->addMediaConversion('medium')
         ->width(400)
         ->height(400);
}
```

### 7.3 تحديث API Resources لتشمل الوسائط

```php
// في كل Resource
'profile_image' => $this->getFirstMediaUrl('profile_image', 'medium'),
'profile_image_thumb' => $this->getFirstMediaUrl('profile_image', 'thumb'),
```

---

## المرحلة 8: التعدد اللغوي — Localization (يوم 25-26)

### 8.1 ملفات الترجمة

```
lang/
├── ar/
│   ├── auth.php
│   ├── enums.php
│   ├── messages.php
│   ├── otp.php
│   ├── password.php
│   ├── validation.php
│   └── join_request.php
└── en/
    ├── auth.php
    ├── enums.php
    ├── messages.php
    ├── otp.php
    ├── password.php
    ├── validation.php
    └── join_request.php
```

### 8.2 مثال ملف ترجمة

**`lang/ar/messages.php`**

```php
<?php

return [
    'success' => 'تمت العملية بنجاح',
    'error' => 'حدث خطأ',
    'not_found' => 'العنصر غير موجود',
    'unauthorized' => 'غير مصرح',
    'forbidden' => 'ممنوع الوصول',
];
```

### 8.3 إعداد Filament للتعدد اللغوي

```php
// في AdminPanelProvider.php
use Filament\SpatieLaravelTranslatablePlugin;

->plugin(
    SpatieLaravelTranslatablePlugin::make()
        ->defaultLocales(['ar', 'en']),
)
```

> هذا يضيف تبويبات اللغة تلقائيًا في نماذج Filament للحقول القابلة للترجمة.

---

## المرحلة 9: الاختبارات (يوم 27-29)

### 9.1 Feature Tests

```bash
php artisan make:test Api/V1/AuthTest
php artisan make:test Api/V1/MemberTest
php artisan make:test Api/V1/NewsTest
php artisan make:test Api/V1/EventTest
php artisan make:test Api/V1/OfferTest
php artisan make:test Api/V1/FundTest
php artisan make:test Api/V1/SuggestionTest
php artisan make:test Api/V1/SupportTest
php artisan make:test Api/V1/NotificationTest
```

### 9.2 مثال: AuthTest

```php
<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_phone()
    {
        $user = User::factory()->create([
            'phone_number' => '0551234567',
            'password' => 'password',
            'status' => 'active',
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => '0551234567',
            'password' => 'password',
        ]);

        $response->assertOk()
                 ->assertJsonStructure(['user', 'token']);
    }

    public function test_inactive_user_cannot_login()
    {
        $user = User::factory()->create([
            'status' => 'pending',
            'password' => 'password',
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'login' => $user->phone_number,
            'password' => 'password',
        ]);

        $response->assertForbidden();
    }

    public function test_otp_can_be_sent()
    {
        $response = $this->postJson('/api/v1/auth/send-otp', [
            'phone_number' => '0551234567',
            'purpose' => 'register',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('otp_codes', [
            'phone_number' => '0551234567',
            'purpose' => 'register',
        ]);
    }
}
```

### 9.3 تشغيل الاختبارات

```bash
php artisan test
php artisan test --filter=AuthTest
php artisan test --coverage
```

---

## المرحلة 10: استخراج ملف Postman Collection (يوم 30)

### 10.1 إعداد Scribe

```bash
php artisan vendor:publish --tag=scribe-config
```

**تعديل `config/scribe.php`:**

```php
return [
    'title' => 'Family Tribe App API',
    'description' => 'API Documentation for Family/Tribe Management Application',
    'base_url' => env('APP_URL'),
    'type' => 'laravel',

    'auth' => [
        'enabled' => true,
        'default' => true,
        'in' => 'bearer',
        'name' => 'Authorization',
        'use_value' => 'Bearer {token}',
        'placeholder' => '{token}',
    ],

    'postman' => [
        'enabled' => true,
        'overrides' => [
            'info.version' => '1.0.0',
        ],
    ],

    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/v1'],
                'domains' => ['*'],
            ],
            'include' => ['*'],
            'exclude' => [],
        ],
    ],

    'examples' => [
        'faker_seed' => 1234,
        'models_source' => ['factoryCreate', 'factoryMake'],
    ],
];
```

### 10.2 إضافة DocBlocks للـ Controllers

```php
/**
 * @group Authentication
 *
 * APIs for user authentication
 */
class AuthController extends Controller
{
    /**
     * Login
     *
     * Authenticate user with phone number or national ID.
     *
     * @bodyParam login string required Phone number or National ID. Example: 0551234567
     * @bodyParam password string required User password. Example: secret123
     *
     * @response 200 {
     *   "user": {
     *     "id": "9a8b7c6d-...",
     *     "full_name": "محمد القحطاني",
     *     "phone_number": "0551234567",
     *     "role": "member",
     *     "status": "active"
     *   },
     *   "token": "1|abc123..."
     * }
     *
     * @response 401 {
     *   "message": "بيانات الدخول غير صحيحة"
     * }
     */
    public function login(Request $request) { /* ... */ }
}
```

### 10.3 توليد الملف

```bash
# توليد التوثيق + ملف Postman
php artisan scribe:generate

# الملف يُنشأ في:
# storage/app/scribe/collection.json  ← ملف Postman
# public/docs/                        ← توثيق HTML تفاعلي
```

### 10.4 محتويات ملف Postman المتوقعة

```
📁 Family Tribe App API
├── 📁 Authentication
│   ├── POST Login
│   ├── POST Send OTP
│   ├── POST Verify OTP
│   ├── POST Join Request
│   ├── POST Reset Password
│   ├── PUT Change Password
│   └── POST Logout
├── 📁 Members
│   ├── GET List Members
│   ├── GET Member Details
│   ├── PUT Update Member
│   └── GET Member Card
├── 📁 News
│   ├── GET List News
│   └── GET News Details
├── 📁 Events
│   ├── GET List Events
│   ├── GET Event Details
│   └── POST RSVP
├── 📁 Offers
│   ├── GET List Offers
│   └── GET Offer Details
├── 📁 Family Fund
│   ├── GET Transactions
│   └── GET Summary
├── 📁 Suggestions
│   └── POST Submit Suggestion
├── 📁 Support
│   └── POST Submit Support Request
├── 📁 Notifications
│   ├── GET List Notifications
│   ├── PUT Mark as Read
│   └── PUT Mark All as Read
└── 📁 Devices
    └── POST Register Device
```

> كل Request يحتوي على: URL, Method, Headers (Authorization + Accept-Language), Body مع أمثلة واقعية، وأمثلة للـ Response.

### 10.5 استيراد الملف في Postman

```
1. افتح Postman
2. File → Import
3. اختر الملف: storage/app/scribe/collection.json
4. اضغط Import
5. أضف Environment Variable: base_url = http://localhost:8000
6. أضف Environment Variable: token = (بعد تسجيل الدخول)
```

---

## المرحلة 11: النشر والتوثيق النهائي (يوم 31-33)

### 11.1 التحسينات النهائية

```bash
# تحسين الأداء
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache

# تشغيل الاختبارات النهائية
php artisan test

# توليد ملف Postman النهائي
php artisan scribe:generate
```

### 11.2 قائمة التحقق النهائية

- [ ] جميع الـ Migrations تعمل بنجاح
- [ ] جميع الـ Models مع العلاقات والـ Media Collections
- [ ] جميع الـ Enums مُعرّفة
- [ ] جميع الـ API Endpoints تعمل وموثقة
- [ ] لوحة Filament مع جميع الـ Resources
- [ ] نظام OTP يعمل
- [ ] نظام طلبات الانضمام (قبول/رفض) يعمل
- [ ] نظام الإشعارات (Laravel Notifications) يعمل
- [ ] Spatie Media Library مُعدّة لجميع الـ Models
- [ ] التعدد اللغوي (ar/en) يعمل في API و Filament
- [ ] الاختبارات تمر بنجاح
- [ ] ملف Postman Collection مُصدّر مع أمثلة
- [ ] التوثيق HTML متاح على `/docs`

### 11.3 أوامر النشر (Production)

```bash
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan optimize
php artisan scribe:generate
```

---

## 📦 ملخص الحزم المطلوبة

| الحزمة | الغرض |
|--------|-------|
| `filament/filament` | لوحة التحكم الإدارية |
| `laravel/sanctum` | API Token Authentication |
| `spatie/laravel-medialibrary` | إدارة الصور والملفات (بديل أعمدة الصور) |
| `spatie/laravel-translatable` | تعدد اللغات JSONB |
| `spatie/laravel-permission` | الأدوار والصلاحيات |
| `filament/spatie-laravel-media-library-plugin` | ربط Media Library مع Filament |
| `filament/spatie-laravel-translatable-plugin` | ربط Translatable مع Filament |
| `knuckleswtf/scribe` | توليد توثيق API + ملف Postman |

---

> **ملاحظة:** هذه الخطة قابلة للتعديل حسب حجم الفريق ومتطلبات العميل. المدة التقديرية 33 يوم عمل لمطور واحد.
