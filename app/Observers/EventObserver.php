<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\User;
use App\Notifications\NewEventCreated;
use Illuminate\Support\Facades\Notification;

class EventObserver
{
    public function created(Event $event): void
    {
        $members = User::where('status', 'active')->get();
        Notification::send($members, new NewEventCreated($event));
    }
}
