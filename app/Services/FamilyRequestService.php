<?php

namespace App\Services;

use App\Enums\FamilyRequestStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Family;
use App\Models\FamilyRequest;
use App\Models\User;
use App\Notifications\AdminFamilyRequestSubmitted;
use App\Notifications\FamilyRequestApprovedForMember;
use App\Notifications\FamilyRequestRejectedForMember;
use App\Support\FamilyNameNormalizer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FamilyRequestService
{
    public const SYSTEM_SUPERSEDED = 'تم استبدال الطلب بطلب أحدث.';

    public function submitFromUser(User $user, string $rawName): FamilyRequest
    {
        if ($user->family_id !== null) {
            throw ValidationException::withMessages([
                'pending_family_name' => [__('messages.family_already_assigned')],
            ]);
        }

        $display = Str::squish($rawName);
        $normalized = FamilyNameNormalizer::normalize($display);

        if ($normalized === '') {
            throw ValidationException::withMessages([
                'pending_family_name' => [__('validation.required', ['attribute' => 'pending_family_name'])],
            ]);
        }

        return DB::transaction(function () use ($user, $display, $normalized) {
            $this->rejectPendingForUser($user, self::SYSTEM_SUPERSEDED);

            $user->forceFill(['pending_family_name' => $display])->save();

            $request = FamilyRequest::query()->create([
                'user_id' => $user->id,
                'name' => $normalized,
                'status' => FamilyRequestStatus::Pending,
            ]);

            $this->notifyAdmins($request);

            return $request;
        });
    }

    public function withdrawFromUser(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->rejectPendingForUser($user, self::SYSTEM_SUPERSEDED);
            $user->forceFill(['pending_family_name' => null])->save();
        });
    }

    public function approveLinkingToExisting(FamilyRequest $request, Family $family, int $reviewerId): void
    {
        DB::transaction(function () use ($request, $family, $reviewerId) {
            $this->assertPending($request);

            $request->user->forceFill([
                'family_id' => $family->id,
                'pending_family_name' => null,
            ])->save();

            $request->forceFill([
                'status' => FamilyRequestStatus::Approved,
                'reviewed_by' => $reviewerId,
                'reviewed_at' => now(),
                'resolved_family_id' => $family->id,
                'rejection_reason' => null,
            ])->save();

            $request->user->notify(new FamilyRequestApprovedForMember($family));
        });
    }

    public function approveCreatingFamily(FamilyRequest $request, string $officialName, ?string $origin, int $reviewerId): Family
    {
        return DB::transaction(function () use ($request, $officialName, $origin, $reviewerId) {
            $this->assertPending($request);

            $normalized = FamilyNameNormalizer::normalize($officialName);

            if ($normalized === '') {
                throw ValidationException::withMessages([
                    'name' => [__('validation.required', ['attribute' => 'name'])],
                ]);
            }

            if (Family::query()->where('normalized_name', $normalized)->exists()) {
                throw ValidationException::withMessages([
                    'name' => [__('messages.family_name_already_exists')],
                ]);
            }

            $family = Family::query()->create([
                'name' => Str::squish($officialName),
                'origin' => $origin !== null ? Str::squish($origin) : null,
            ]);

            $request->user->forceFill([
                'family_id' => $family->id,
                'pending_family_name' => null,
            ])->save();

            $request->forceFill([
                'status' => FamilyRequestStatus::Approved,
                'reviewed_by' => $reviewerId,
                'reviewed_at' => now(),
                'resolved_family_id' => $family->id,
                'rejection_reason' => null,
            ])->save();

            $request->user->notify(new FamilyRequestApprovedForMember($family));

            return $family;
        });
    }

    public function reject(FamilyRequest $request, string $reason, int $reviewerId): void
    {
        DB::transaction(function () use ($request, $reason, $reviewerId) {
            $this->assertPending($request);

            $request->user->forceFill(['pending_family_name' => null])->save();

            $request->forceFill([
                'status' => FamilyRequestStatus::Rejected,
                'reviewed_by' => $reviewerId,
                'reviewed_at' => now(),
                'rejection_reason' => $reason,
            ])->save();

            $request->user->notify(new FamilyRequestRejectedForMember($reason));
        });
    }

    public function findFamilyByNormalizedName(string $normalized): ?Family
    {
        if ($normalized === '') {
            return null;
        }

        return Family::query()->where('normalized_name', $normalized)->first();
    }

    public function rejectPendingForUser(User $user, string $reason): void
    {
        FamilyRequest::query()
            ->where('user_id', $user->id)
            ->where('status', FamilyRequestStatus::Pending)
            ->update([
                'status' => FamilyRequestStatus::Rejected,
                'rejection_reason' => $reason,
                'reviewed_at' => now(),
            ]);
    }

    protected function assertPending(FamilyRequest $request): void
    {
        if ($request->status !== FamilyRequestStatus::Pending) {
            throw ValidationException::withMessages([
                'family_request' => [__('messages.family_request_not_pending')],
            ]);
        }
    }

    protected function notifyAdmins(FamilyRequest $request): void
    {
        $request->loadMissing('user');

        User::query()
            ->where('role', UserRole::Admin)
            ->where('status', UserStatus::Active)
            ->each(fn (User $admin) => $admin->notify(new AdminFamilyRequestSubmitted($request)));
    }
}
