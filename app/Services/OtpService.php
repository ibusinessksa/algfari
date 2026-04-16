<?php

namespace App\Services;

use App\Enums\OtpPurpose;
use App\Models\OtpCode;

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
            // 'code' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'code' => "123456",
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

        if (!$otp) {
            return false;
        }

        $otp->update(['is_used' => true]);

        return true;
    }

    public function send(string $phone, string $code): void
    {
        // Integration with Twilio / MessageBird
        // TODO: Implement SMS sending based on OTP_DRIVER config
        logger()->info("OTP code {$code} sent to {$phone}");
    }
}
