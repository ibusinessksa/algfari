<?php

namespace App\Observers;

use App\Models\Offer;
use App\Models\User;
use App\Notifications\NewOfferPublished;
use Illuminate\Support\Facades\Notification;

class OfferObserver
{
    public function created(Offer $offer): void
    {
        $members = User::where('status', 'active')->get();
        Notification::send($members, new NewOfferPublished($offer));
    }
}
