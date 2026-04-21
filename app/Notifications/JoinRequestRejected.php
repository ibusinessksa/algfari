<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JoinRequestRejected extends Notification
{
    use Queueable;

    public function __construct(
        private string $reason = '',
        private ?string $applicantDisplayName = null,
    ) {}

    public function via(object $notifiable): array
    {
        if ($notifiable instanceof AnonymousNotifiable) {
            return ['mail'];
        }

        return array_values(array_filter([
            'database',
            filled($notifiable instanceof User ? $notifiable->email : null) ? 'mail' : null,
        ]));
    }

    public function toMail(object $notifiable): MailMessage
    {
        $name = $this->recipientDisplayName($notifiable);

        $mail = (new MailMessage)
            ->subject(__('emails.join_request_rejected_subject'))
            ->greeting(__('emails.join_request_rejected_greeting', ['name' => $name]))
            ->line(__('emails.join_request_rejected_line'));

        if ($this->reason !== '') {
            $mail->line(__('emails.join_request_rejected_reason').' '.$this->reason);
        }

        return $mail;
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => [
                'ar' => 'تم رفض طلب انضمامك',
                'en' => 'Your join request has been rejected',
            ],
            'body' => [
                'ar' => 'للأسف تم رفض طلب انضمامك.'.($this->reason ? ' السبب: '.$this->reason : ''),
                'en' => 'Unfortunately your join request has been rejected.'.($this->reason ? ' Reason: '.$this->reason : ''),
            ],
            'type' => 'join_request_rejected',
            'rejection_reason' => $this->reason,
        ];
    }

    private function recipientDisplayName(object $notifiable): string
    {
        if ($notifiable instanceof User) {
            return $notifiable->full_name;
        }

        return $this->applicantDisplayName ?? __('emails.guest');
    }
}
