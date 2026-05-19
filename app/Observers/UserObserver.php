<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user): void
    {
        if (! $user->member_card_number) {
            $user->member_card_number = $this->generateCardNumber();
        }
    }

    private function generateCardNumber(): string
    {
        do {
            $candidate = 'QF-' . str_pad((string) random_int(0, 9999999), 7, '0', STR_PAD_LEFT);
        } while (User::where('member_card_number', $candidate)->exists());

        return $candidate;
    }
}
