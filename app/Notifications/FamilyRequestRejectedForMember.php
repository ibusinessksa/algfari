<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FamilyRequestRejectedForMember extends Notification
{
    use Queueable;

    public function __construct(
        public string $reason
    ) {}

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

        $mail = (new MailMessage)
            ->subject(__('emails.family_request_rejected_subject'))
            ->greeting(__('emails.family_request_rejected_greeting', ['name' => $name]))
            ->line(__('emails.family_request_rejected_line'));

        if ($this->reason !== '') {
            $mail->line(__('emails.family_request_rejected_reason').' '.$this->reason);
        }

        return $mail;
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
