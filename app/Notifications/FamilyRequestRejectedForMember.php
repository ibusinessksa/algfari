<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FamilyRequestRejectedForMember extends Notification
{
    use Queueable;

    public function __construct(
        public string $reason
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => [
                'ar' => 'تم رفض طلب العائلة',
                'en' => 'Your family request was rejected',
            ],
            'body' => [
                'ar' => $this->reason,
                'en' => $this->reason,
            ],
            'type' => 'family_request_rejected',
        ];
    }
}
