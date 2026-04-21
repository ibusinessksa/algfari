<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OtpPurpose;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ChangePasswordRequest;
use App\Http\Requests\Api\V1\JoinRequestFormRequest;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\ResetPasswordRequest;
use App\Http\Requests\Api\V1\SendOtpRequest;
use App\Http\Requests\Api\V1\VerifyOtpRequest;
use App\Http\Resources\Api\V1\JoinRequestResource;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\JoinRequest;
use App\Models\User;
use App\Models\UserDevice;
use App\Services\OtpService;
use App\Support\PasswordResetSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication
 *
 * APIs for user authentication and registration.
 */
class AuthController extends Controller
{
    public function __construct(private OtpService $otpService) {}

    /**
     * Login
     *
     * Authenticate user with phone number or national ID.
     *
     * @unauthenticated
     *
     * @bodyParam login string required Phone number or National ID. Example: 0551234567
     * @bodyParam password string required User password. Example: secret123
     * @bodyParam device_token string Optional FCM token; if sent, `platform` is required. Example: fcm-token-abc123xyz
     * @bodyParam platform string Optional `ios` or `android`; required with `device_token`. Example: android
     *
     * @response 200 scenario="success" {
     *   "user": {
     *     "id": 1,
     *     "full_name": "محمد القحطاني",
     *     "phone_number": "0551234567",
     *     "national_id": "1234567890",
     *     "email": "mohammed@example.com",
     *     "city": "الرياض",
     *     "region": "منطقة الرياض",
     *     "gender": "male",
     *     "role": "member",
     *     "status": "active",
     *     "is_featured": false,
     *     "profile_image": null,
     *     "profile_image_medium": null,
     *     "profile_image_thumb": null,
     *     "created_at": "2026-04-01T10:00:00.000000Z"
     *   },
     *   "token": "1|a2b3c4d5e6f7g8h9i0jklmnopqrstuvwxyz"
     * }
     * @response 401 scenario="invalid credentials" {"message": "بيانات الدخول غير صحيحة"}
     * @response 403 scenario="inactive account" {"message": "الحساب غير مفعل"}
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('phone_number', $request->login)
            ->orWhere('national_id', $request->login)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => __('auth.failed')], 401);
        }

        if ($user->status !== UserStatus::Active) {
            return response()->json(['message' => __('auth.inactive')], 403);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        if ($request->filled('device_token') && $request->filled('platform')) {
            UserDevice::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'device_token' => $request->string('device_token')->toString(),
                ],
                [
                    'platform' => $request->string('platform')->toString(),
                    'is_active' => true,
                    'last_used_at' => now(),
                ]
            );
        }

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    /**
     * Send OTP
     *
     * Send a one-time password to the given phone number.
     *
     * @unauthenticated
     *
     * @bodyParam phone_number string required The phone number. Example: 0551234567
     * @bodyParam purpose string required The OTP purpose. Example: register
     *
     * @response 200 {"message": "تم إرسال رمز التحقق"}
     */
    public function sendOtp(SendOtpRequest $request): JsonResponse
    {
        $purpose = OtpPurpose::from($request->purpose);

        if ($purpose === OtpPurpose::Reset) {
            PasswordResetSession::forget(PasswordResetSession::normalizePhone($request->phone_number));
        }

        $otp = $this->otpService->generate($request->phone_number, $purpose);

        $this->otpService->send($request->phone_number, $otp->code);

        return response()->json(['message' => __('otp.sent')]);
    }

    /**
     * Verify OTP
     *
     * Verify the OTP code sent to the phone number.
     *
     * @unauthenticated
     *
     * @bodyParam phone_number string required The phone number. Example: 0551234567
     * @bodyParam code string required The OTP code. Example: 123456
     * @bodyParam purpose string required One of: register, reset, verify. For password recovery use reset (then call reset-password without code).
     *
     * @response 200 {"message": "تم التحقق بنجاح", "verified": true}
     * @response 422 {"message": "رمز التحقق غير صالح"}
     */
    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        $purpose = OtpPurpose::from($request->purpose);

        $valid = $this->otpService->verify(
            $request->phone_number,
            $request->code,
            $purpose
        );

        if (! $valid) {
            return response()->json(['message' => __('otp.invalid')], 422);
        }

        if ($purpose === OtpPurpose::Reset) {
            PasswordResetSession::markOtpVerified(
                PasswordResetSession::normalizePhone($request->phone_number)
            );
        }

        return response()->json(['message' => __('otp.verified'), 'verified' => true]);
    }

    /**
     * Join Request
     *
     * Submit a request to join the family/tribe.
     *
     * @unauthenticated
     *
     * @bodyParam full_name string required Full name of the applicant. Example: محمد أحمد القحطاني
     * @bodyParam phone_number string required Phone number. Example: 0551234567
     * @bodyParam national_id string National ID number. Example: 1234567890
     * @bodyParam email string Email address. Example: mohammed@example.com
     * @bodyParam pending_family_name string Optional free-text family name (stored until admin links the member after approval).
     * @bodyParam region_id int Optional linked region id (`regions.id`). Example: 1
     * @bodyParam password string required Password (min 6 chars). Example: secret123
     * @bodyParam password_confirmation string required Password confirmation. Example: secret123
     * @bodyParam profile_image file Profile image (max 5MB, image format).
     *
     * @response 201 scenario="success" {
     *   "message": "تم تقديم طلب الانضمام بنجاح",
     *   "join_request": {
     *     "id": 1,
     *     "full_name": "محمد أحمد القحطاني",
     *     "phone_number": "0551234567",
     *     "national_id": "1234567890",
     *     "email": "mohammed@example.com",
     *     "pending_family_name": null,
     *     "region_id": 1,
     *     "region": {"id": 1, "country_id": 1, "name": {"ar": "منطقة الرياض", "en": "Riyadh Region"}},
     *     "status": "pending",
     *     "rejection_reason": null,
     *     "profile_image": null,
     *     "profile_image_medium": null,
     *     "profile_image_thumb": null,
     *     "reviewed_at": null,
     *     "created_at": "2026-04-13T10:00:00.000000Z"
     *   }
     * }
     */
    public function joinRequest(JoinRequestFormRequest $request): JsonResponse
    {
        $joinRequest = JoinRequest::create(
            $request->safe()->except(['profile_image', 'password_confirmation'])
        );

        if ($request->hasFile('profile_image')) {
            $joinRequest->addMediaFromRequest('profile_image')
                ->toMediaCollection('profile_image');
        }

        $joinRequest->load('region');

        return response()->json([
            'message' => __('join_request.submitted'),
            'join_request' => new JoinRequestResource($joinRequest),
        ], 201);
    }

    /**
     * Reset Password
     *
     * Step 3 of password recovery (UI): set a new password after OTP was verified in
     * `verify-otp` with purpose `reset`. Does not accept the code again.
     *
     * @unauthenticated
     *
     * @bodyParam phone_number string required Same phone used for send-otp / verify-otp. Example: 0551234567
     * @bodyParam password string required New password (min 6 chars). Example: newsecret123
     * @bodyParam password_confirmation string required Password confirmation. Example: newsecret123
     *
     * @response 200 {"message": "تم إعادة تعيين كلمة المرور بنجاح"}
     * @response 422 {"message": "..."}
     * @response 404 {"message": "المستخدم غير موجود"}
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $phone = PasswordResetSession::normalizePhone($request->phone_number);

        if (! PasswordResetSession::pullVerified($phone)) {
            return response()->json(['message' => __('password.reset_session_invalid')], 422);
        }

        $user = User::where('phone_number', $phone)->first();

        if (! $user) {
            return response()->json(['message' => __('auth.user_not_found')], 404);
        }

        $user->update(['password' => $request->password]);

        return response()->json(['message' => __('password.reset_success')]);
    }

    /**
     * Change Password
     *
     * Change the authenticated user's password.
     *
     * @bodyParam current_password string required Current password. Example: oldsecret123
     * @bodyParam password string required New password (min 6 chars). Example: newsecret123
     * @bodyParam password_confirmation string required Password confirmation. Example: newsecret123
     *
     * @response 200 {"message": "تم تغيير كلمة المرور بنجاح"}
     * @response 422 {"message": "كلمة المرور الحالية غير صحيحة"}
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => __('password.incorrect')], 422);
        }

        $user->update(['password' => $request->password]);

        return response()->json(['message' => __('password.changed')]);
    }

    /**
     * Logout
     *
     * Revoke the current access token.
     *
     * @response 200 {"message": "تم تسجيل الخروج بنجاح"}
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => __('auth.logged_out')]);
    }
}
