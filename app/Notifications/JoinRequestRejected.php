<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JoinRequestRejected extends Notification
{
    use Queueable;

    public function __construct(private string $reason = '') {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => [
                'ar' => 'تم رفض طلب انضمامك',
                'en' => 'Your join request has been rejected',
            ],
            'body' => [
                'ar' => 'للأسف تم رفض طلب انضمامك.' . ($this->reason ? ' السبب: ' . $this->reason : ''),
                'en' => 'Unfortunately your join request has been rejected.' . ($this->reason ? ' Reason: ' . $this->reason : ''),
            ],
            'type' => 'join_request_rejected',
            'rejection_reason' => $this->reason,
        ];
    }
}
