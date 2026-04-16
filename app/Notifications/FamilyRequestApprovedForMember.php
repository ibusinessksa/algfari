<?php

namespace App\Notifications;

use App\Models\Family;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FamilyRequestApprovedForMember extends Notification
{
    use Queueable;

    public function __construct(
        public Family $family
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => [
                'ar' => 'تم اعتماد العائلة',
                'en' => 'Your family was approved',
            ],
            'body' => [
                'ar' => sprintf('تم ربطك بالعائلة: %s', $this->family->name),
                'en' => sprintf('You are now linked to family: %s', $this->family->name),
            ],
            'type' => 'family_request_approved',
            'family_id' => $this->family->id,
        ];
    }
}
