<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JoinRequestApproved extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => [
                'ar' => 'تم قبول طلب انضمامك',
                'en' => 'Your join request has been approved',
            ],
            'body' => [
                'ar' => 'مرحبًا بك في العائلة! يمكنك الآن تسجيل الدخول.',
                'en' => 'Welcome to the family! You can now log in.',
            ],
            'type' => 'join_request_approved',
            'action_url' => '/login',
        ];
    }
}
