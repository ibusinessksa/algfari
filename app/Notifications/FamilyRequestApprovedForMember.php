<?php

namespace App\Notifications;

use App\Models\Family;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FamilyRequestApprovedForMember extends Notification
{
    use Queueable;

    public function __construct(
        public Family $family
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

        return (new MailMessage)
            ->subject(__('emails.family_request_approved_subject'))
            ->greeting(__('emails.family_request_approved_greeting', ['name' => $name]))
            ->line(__('emails.family_request_approved_line', ['family' => $this->family->name]));
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
