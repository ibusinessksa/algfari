<?php

namespace App\Services;

use App\Mail\EmailVerificationMail;
use App\Models\EmailVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailVerificationService
{
    public function send(User $user): void
    {
        // Invalidate any previous unused codes for this user
        EmailVerificationCode::where('user_id', $user->id)
            ->where('is_used', false)
            ->update(['is_used' => true]);

        // $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $code = "123456";

        EmailVerificationCode::create([
            'user_id'    => $user->id,
            'email'      => $user->email,
            'code'       => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(
            new EmailVerificationMail($code, $user->full_name)
        );
    }

    public function verify(User $user, string $code): bool
    {
        $record = EmailVerificationCode::where('user_id', $user->id)
            ->where('email', $user->email)
            ->where('code', $code)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (! $record) {
            return false;
        }

        $record->update(['is_used' => true]);

        $user->update(['email_verified_at' => now()]);
        return true;
    }
}
