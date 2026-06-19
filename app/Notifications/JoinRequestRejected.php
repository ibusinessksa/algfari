<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JoinRequestRejected extends Notification
{
    use Queueable;

    public function __construct(private ?string $reason = null) {}

    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(object $notifiable): array
    {
        [$titleAr, $titleEn] = $this->titles();
        [$bodyAr, $bodyEn] = $this->bodies();

        return [
            'title' => ['ar' => $titleAr, 'en' => $titleEn],
            'body' => ['ar' => $bodyAr, 'en' => $bodyEn],
            'type' => 'join_request_rejected',
            'rejection_reason' => $this->reason,
        ];
    }

    public function toFcm(object $notifiable): array
    {
        [$titleAr, $titleEn] = $this->titles();
        [$bodyAr, $bodyEn] = $this->bodies();

        return [
            'title' => $titleAr,
            'body' => $bodyAr,
            'data' => [
                'type' => 'join_request_rejected',
                'rejection_reason' => $this->reason,
                'title_ar' => $titleAr,
                'title_en' => $titleEn,
                'body_ar' => $bodyAr,
                'body_en' => $bodyEn,
            ],
        ];
    }

    /** @return array{0:string,1:string} */
    private function titles(): array
    {
        return [
            'تم رفض طلب انضمامك',
            'Your join request has been rejected',
        ];
    }

    /** @return array{0:string,1:string} */
    private function bodies(): array
    {
        return [
            'للأسف تم رفض طلب انضمامك.'.($this->reason ? ' السبب: '.$this->reason : ''),
            'Unfortunately your join request has been rejected.'.($this->reason ? ' Reason: '.$this->reason : ''),
        ];
    }
}
