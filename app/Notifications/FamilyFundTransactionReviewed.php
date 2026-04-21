<?php

namespace App\Notifications;

use App\Models\FamilyFundTransaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class FamilyFundTransactionReviewed extends Notification
{
    use Queueable, SerializesModels;

    public function __construct(
        public FamilyFundTransaction $transaction,
        public bool $approved
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
        $subjectKey = $this->approved
            ? 'emails.fund_transaction_approved_subject'
            : 'emails.fund_transaction_rejected_subject';

        $mail = (new MailMessage)
            ->subject(__($subjectKey))
            ->greeting(__('emails.fund_transaction_greeting', ['name' => $name]))
            ->line(__('emails.fund_transaction_line_type', ['type' => $this->transaction->transaction_type->label()]))
            ->line(__('emails.fund_transaction_line_amount', ['amount' => number_format((float) $this->transaction->amount, 2)]));

        if ($this->approved) {
            $mail->line(__('emails.fund_transaction_approved_line'));
        } else {
            $mail->line(__('emails.fund_transaction_rejected_line'));
        }

        return $mail;
    }

    public function toArray(object $notifiable): array
    {
        if ($this->approved) {
            return [
                'title' => [
                    'ar' => 'تم اعتماد معاملة الصندوق',
                    'en' => 'Family fund transaction approved',
                ],
                'body' => [
                    'ar' => sprintf('المبلغ: %s ريال', number_format((float) $this->transaction->amount, 2)),
                    'en' => sprintf('Amount: %s SAR', number_format((float) $this->transaction->amount, 2)),
                ],
                'type' => 'family_fund_transaction_approved',
                'transaction_id' => $this->transaction->id,
            ];
        }

        return [
            'title' => [
                'ar' => 'تم رفض معاملة الصندوق',
                'en' => 'Family fund transaction rejected',
            ],
            'body' => [
                'ar' => sprintf('المبلغ: %s ريال', number_format((float) $this->transaction->amount, 2)),
                'en' => sprintf('Amount: %s SAR', number_format((float) $this->transaction->amount, 2)),
            ],
            'type' => 'family_fund_transaction_rejected',
            'transaction_id' => $this->transaction->id,
        ];
    }
}
