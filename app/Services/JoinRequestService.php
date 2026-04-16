<?php

namespace App\Services;

use App\Enums\JoinRequestStatus;
use App\Enums\UserStatus;
use App\Models\JoinRequest;
use App\Models\User;
use App\Notifications\JoinRequestApproved;
use Illuminate\Support\Facades\Hash;

class JoinRequestService
{
    public function __construct(
        protected FamilyRequestService $familyRequestService
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
            'city' => $joinRequest->city,
            'region' => $joinRequest->region,
            'gender' => 'male',
            'status' => UserStatus::Active,
            'approved_by' => $reviewerId,
            'approved_at' => now(),
        ]);

        $joinRequest->update(['user_id' => $user->id]);

        // Transfer profile image if exists
        if ($joinRequest->hasMedia('profile_image')) {
            $joinRequest->getFirstMedia('profile_image')->copy($user, 'profile_image');
        }

        if (filled($joinRequest->pending_family_name)) {
            $this->familyRequestService->submitFromUser($user->fresh(), (string) $joinRequest->pending_family_name);
        }

        $user->notify(new JoinRequestApproved());

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
    }
}
