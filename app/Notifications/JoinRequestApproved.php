<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JoinRequestApproved extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return array_values(array_filter([
            'database',
            filled($notifiable instanceof User ? $notifiable->email : null) ? 'mail' : null,
        ]));
    }

    public function toMail(object $notifiable): MailMessage
    {
        $name = $notifiable instanceof User ? $notifiable->full_name : __('emails.guest');

        return (new MailMessage)
            ->subject(__('emails.join_request_approved_subject'))
            ->greeting(__('emails.join_request_approved_greeting', ['name' => $name]))
            ->line(__('emails.join_request_approved_line'));
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
}
