<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JoinRequestApproved extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(object $notifiable): array
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

    public function toFcm(object $notifiable): array
    {
        $titleAr = 'تم قبول طلب انضمامك';
        $titleEn = 'Your join request has been approved';
        $bodyAr = 'مرحبًا بك في العائلة! يمكنك الآن تسجيل الدخول.';
        $bodyEn = 'Welcome to the family! You can now log in.';

        return [
            'title' => $titleAr,
            'body' => $bodyAr,
            'data' => [
                'type' => 'join_request_approved',
                'action_url' => '/login',
                'title_ar' => $titleAr,
                'title_en' => $titleEn,
                'body_ar' => $bodyAr,
                'body_en' => $bodyEn,
            ],
        ];
    }
}
