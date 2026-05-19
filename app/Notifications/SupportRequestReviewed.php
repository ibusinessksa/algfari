<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Enums\SupportRequestStatus;
use App\Models\SupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SupportRequestReviewed extends Notification
{
    use Queueable;

    public function __construct(public SupportRequest $supportRequest) {}

    public function via(mixed $_notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(mixed $_notifiable): array
    {
        [$titleAr, $titleEn] = $this->titles();
        [$bodyAr, $bodyEn] = $this->bodies();

        return [
            'title' => ['ar' => $titleAr, 'en' => $titleEn],
            'body' => ['ar' => $bodyAr, 'en' => $bodyEn],
            'type' => 'support_request_reviewed',
            'support_request_id' => $this->supportRequest->id,
            'status' => $this->supportRequest->status->value,
        ];
    }

    public function toFcm(mixed $_notifiable): array
    {
        [$titleAr, $titleEn] = $this->titles();
        [$bodyAr, $bodyEn] = $this->bodies();

        return [
            'title' => $titleAr,
            'body' => $bodyAr,
            'data' => [
                'type' => 'support_request_reviewed',
                'support_request_id' => (string) $this->supportRequest->id,
                'status' => $this->supportRequest->status->value,
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
        return match ($this->supportRequest->status) {
            SupportRequestStatus::Approved => [
                'تم قبول طلب المساعدة',
                'Your support request was approved',
            ],
            SupportRequestStatus::Rejected => [
                'تم رفض طلب المساعدة',
                'Your support request was rejected',
            ],
            default => [
                'تم تحديث حالة طلب المساعدة',
                'Your support request status was updated',
            ],
        };
    }

    /** @return array{0:string,1:string} */
    private function bodies(): array
    {
        $title = (string) $this->supportRequest->title;

        return match ($this->supportRequest->status) {
            SupportRequestStatus::Approved => [
                sprintf('تم قبول طلبك "%s".', $title),
                sprintf('Your request "%s" has been approved.', $title),
            ],
            SupportRequestStatus::Rejected => [
                sprintf('نأسف، تم رفض طلبك "%s".', $title),
                sprintf('Unfortunately, your request "%s" was rejected.', $title),
            ],
            default => [
                sprintf('تم تحديث حالة طلبك "%s".', $title),
                sprintf('The status of your request "%s" was updated.', $title),
            ],
        };
    }
}
