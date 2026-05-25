<?php

namespace App\Services;

use App\Enums\JoinRequestStatus;
use App\Enums\UserStatus;
use App\Models\JoinRequest;
use App\Models\User;
use App\Models\UserDevice;
use App\Notifications\JoinRequestApproved;
use App\Notifications\JoinRequestRejected;
use Illuminate\Support\Facades\Hash;

class JoinRequestService
{
    public function __construct(
        protected FamilyRequestService $familyRequestService,
        protected FcmService $fcm,
    ) {}

    public function submit(array $data, ?string $passwordHash = null): JoinRequest
    {
        $joinRequest = JoinRequest::create(array_merge($data, [
            'status' => JoinRequestStatus::Pending,
        ]));

        return $joinRequest;
    }

    public function approve(JoinRequest $joinRequest, string $reviewerId, ?string $passwordHash = null): User
    {
        $joinRequest->update([
            'status' => JoinRequestStatus::Approved,
            'reviewed_by' => $reviewerId,
            'reviewed_at' => now(),
        ]);

        $user = User::create([
            'full_name' => $joinRequest->full_name,
            'phone_number' => $joinRequest->phone_number,
            'national_id' => $joinRequest->national_id,
            'email' => $joinRequest->email,
            'password' => $joinRequest->password ?? $passwordHash ?? Hash::make('changeme'),
            'city_id' => null,
            'region_id' => $joinRequest->region_id,
            'gender' => $joinRequest->gender ?? 'male',
            'status' => UserStatus::Active,
            'approved_by' => $reviewerId,
            'approved_at' => now(),
        ]);

        $joinRequest->update(['user_id' => $user->id]);

        if (filled($joinRequest->device_token) && filled($joinRequest->platform)) {
            UserDevice::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'device_token' => $joinRequest->device_token,
                ],
                [
                    'platform' => $joinRequest->platform,
                    'is_active' => true,
                    'last_used_at' => now(),
                ]
            );
        }

        // Transfer profile image if exists
        if ($joinRequest->hasMedia('profile_image')) {
            $joinRequest->getFirstMedia('profile_image')->copy($user, 'profile_image');
        }

        if (filled($joinRequest->pending_family_name)) {
            $this->familyRequestService->submitFromUser($user->fresh(), (string) $joinRequest->pending_family_name);
        }

        $user->notify(new JoinRequestApproved);

        return $user->fresh();
    }

    public function reject(JoinRequest $joinRequest, string $reviewerId, string $reason): void
    {
        $joinRequest->update([
            'status' => JoinRequestStatus::Rejected,
            'reviewed_by' => $reviewerId,
            'reviewed_at' => now(),
            'rejection_reason' => $reason,
        ]);

        if ($joinRequest->user) {
            $joinRequest->user->notify(new JoinRequestRejected($reason));
        } elseif (filled($joinRequest->device_token)) {
            $titleAr = 'تم رفض طلب انضمامك';
            $titleEn = 'Your join request has been rejected';
            $bodyAr = 'للأسف تم رفض طلب انضمامك.'.($reason !== '' ? ' السبب: '.$reason : '');
            $bodyEn = 'Unfortunately your join request has been rejected.'.($reason !== '' ? ' Reason: '.$reason : '');

            $this->fcm->send(
                (string) $joinRequest->device_token,
                $titleAr,
                $bodyAr,
                [
                    'type' => 'join_request_rejected',
                    'rejection_reason' => $reason,
                    'title_ar' => $titleAr,
                    'title_en' => $titleEn,
                    'body_ar' => $bodyAr,
                    'body_en' => $bodyEn,
                ],
            );
        }
    }
}
