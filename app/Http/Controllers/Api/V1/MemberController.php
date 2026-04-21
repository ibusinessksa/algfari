<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterDeviceRequest;
use App\Http\Requests\Api\V1\UpdateMemberRequest;
use App\Http\Resources\Api\V1\MemberCardResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Models\UserDevice;
use App\Services\FamilyRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Members
 *
 * APIs for managing family/tribe members.
 */
class MemberController extends Controller
{
    public function __construct(
        protected FamilyRequestService $familyRequestService
    ) {}

    /**
     * List Members
     *
     * Get a paginated list of active members. Supports search and filtering.
     *
     * @queryParam search string Search by name or phone. Example: محمد
     * @queryParam family string Search member family name (partial match).
     * @queryParam family_id int Filter by linked family id.
     * @queryParam city string Filter by city. Example: الرياض
     * @queryParam gender string Filter by gender (male/female). Example: male
     * @queryParam is_featured boolean Filter featured members only. Example: 1
     * @queryParam per_page integer Items per page. Example: 15
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "full_name": "محمد القحطاني",
     *       "phone_number": "0551234567",
     *       "national_id": "1234567890",
     *       "email": "mohammed@example.com",
     *       "city": "الرياض",
     *       "region": "منطقة الرياض",
     *       "bio": "مهندس برمجيات",
     *       "gender": "male",
     *       "role": "member",
     *       "status": "active",
     *       "is_featured": false,
     *       "profile_image": null,
     *       "created_at": "2026-04-01T10:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/members?page=1", "last": "http://algfari.test/api/v1/members?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 15, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $members = User::query()
            ->where('status', 'active')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('family_id'), fn ($q) => $q->where('family_id', $request->integer('family_id')))
            ->when($request->filled('family'), function ($q) use ($request) {
                $needle = $request->input('family');
                $q->whereHas('family', fn ($fq) => $fq->where('name', 'like', '%'.$needle.'%'));
            })
            ->when($request->city_id, fn ($q, $v) => $q->where('city_id', $v))
            ->when($request->gender, fn ($q, $v) => $q->where('gender', $v))
            ->when($request->boolean('is_featured'), fn ($q) => $q->where('is_featured', true))
            ->latest()
            ->paginate($request->input('per_page', 15));

        return UserResource::collection($members);
    }

    /**
     * Member Details
     *
     * Get detailed information about a specific member.
     *
     * @urlParam member int required The member user id. Example: 1
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "id": 1,
     *     "full_name": "محمد القحطاني",
     *     "phone_number": "0551234567",
     *     "national_id": "1234567890",
     *     "email": "mohammed@example.com",
     *     "city": "الرياض",
     *     "region": "منطقة الرياض",
     *     "bio": "مهندس برمجيات",
     *     "gender": "male",
     *     "role": "member",
     *     "status": "active",
     *     "is_featured": false,
     *     "social_links": {"twitter": "https://twitter.com/mohammed"},
     *     "profile_image": "http://algfari.test/storage/media/1/profile.jpg",
     *     "created_at": "2026-04-01T10:00:00.000000Z"
     *   }
     * }
     */
    public function show(User $member): UserResource
    {
        $member->load([
            'family',
            'city.region.country',
            'region.country',
            'sons.linkedUser',
            'daughters.linkedUser',
        ]);

        return new UserResource($member);
    }

    /**
     * Update Member
     *
     * Update a member's profile information.
     *
     * @urlParam member int required The member user id. Example: 1
     *
     * @bodyParam full_name string Full name. Example: محمد أحمد
     * @bodyParam email string Email address. Example: mohammed@example.com
     * @bodyParam pending_family_name string Free-text family name (creates admin review request). Send empty to withdraw.
     * @bodyParam family_id int Admin only: set linked family.
     * @bodyParam city string City. Example: الرياض
     * @bodyParam region string Region. Example: منطقة الرياض
     * @bodyParam bio string Biography. Example: مطور برمجيات
     * @bodyParam social_links object Social media links.
     * @bodyParam profile_image file Profile image (max 5MB).
     *
     * @response 200 scenario="success" {
     *   "message": "تم التحديث بنجاح",
     *   "user": {
     *     "id": 1,
     *     "full_name": "محمد أحمد",
     *     "phone_number": "0551234567",
     *     "email": "mohammed@example.com",
     *     "city": "الرياض",
     *     "region": "منطقة الرياض",
     *     "bio": "مطور برمجيات",
     *     "gender": "male",
     *     "role": "member",
     *     "status": "active",
     *     "is_featured": false
     *   }
     * }
     * @response 422 scenario="validation error" {
     *   "message": "The given data was invalid.",
     *   "errors": {"email": ["The email has already been taken."]}
     * }
     */
    public function update(UpdateMemberRequest $request, User $member): JsonResponse
    {
        $excludeFromMassAssign = ['profile_image', 'pending_family_name'];

        if ($request->user()->role !== UserRole::Admin) {
            $excludeFromMassAssign[] = 'family_id';
        }

        $member->update($request->safe()->except($excludeFromMassAssign));

        if ($request->user()->role === UserRole::Admin && $request->exists('family_id') && filled($request->input('family_id'))) {
            $this->familyRequestService->rejectPendingForUser($member->fresh(), FamilyRequestService::SYSTEM_SUPERSEDED);
            $member->fresh()->update(['pending_family_name' => null]);
        }

        if ($request->has('pending_family_name')) {
            if (filled($request->input('pending_family_name'))) {
                $this->familyRequestService->submitFromUser($member->fresh(), (string) $request->input('pending_family_name'));
            } else {
                $this->familyRequestService->withdrawFromUser($member->fresh());
            }
        }

        $member = $member->fresh();

        if ($request->hasFile('profile_image')) {
            $member->addMediaFromRequest('profile_image')
                ->toMediaCollection('profile_image');
        }

        $member = $member->fresh();
        $member->load([
            'family',
            'city.region.country',
            'region.country',
            'sons.linkedUser',
            'daughters.linkedUser',
        ]);

        return response()->json([
            'message' => __('messages.updated'),
            'user' => new UserResource($member),
        ]);
    }

    /**
     * Member Card
     *
     * Get the membership card information for a member.
     *
     * @urlParam member int required The member user id. Example: 1
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "id": 1,
     *     "full_name": "محمد القحطاني",
     *     "phone_number": "0551234567",
     *     "national_id": "1234567890",
     *     "city": "الرياض",
     *     "region": "منطقة الرياض",
     *     "gender": "male",
     *     "role": "member",
     *     "profile_image": "http://algfari.test/storage/media/1/profile.jpg"
     *   }
     * }
     */
    public function card(User $member): MemberCardResource
    {
        $member->load([
            'family',
            'city.region',
            'sons.linkedUser',
            'daughters.linkedUser',
        ]);

        return new MemberCardResource($member);
    }

    /**
     * Register Device
     *
     * Register a device for push notifications.
     *
     * @group Devices
     *
     * @bodyParam device_token string required The FCM device token. Example: fcm-token-abc123xyz
     * @bodyParam platform string required The device platform. Example: android
     *
     * @response 200 {"message": "تم تسجيل الجهاز بنجاح"}
     */
    public function registerDevice(RegisterDeviceRequest $request): JsonResponse
    {
        UserDevice::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'device_token' => $request->device_token,
            ],
            [
                'platform' => $request->platform,
                'is_active' => true,
                'last_used_at' => now(),
            ]
        );

        return response()->json(['message' => __('messages.device_registered')]);
    }
}
