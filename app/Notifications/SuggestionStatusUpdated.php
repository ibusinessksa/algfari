<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Enums\SuggestionStatus;
use App\Models\Suggestion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SuggestionStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(public Suggestion $suggestion) {}

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
            'type' => 'suggestion_status_updated',
            'suggestion_id' => $this->suggestion->id,
            'status' => $this->suggestion->status->value,
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
                'type' => 'suggestion_status_updated',
                'suggestion_id' => (string) $this->suggestion->id,
                'status' => $this->suggestion->status->value,
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
            'تم تحديث حالة اقتراحك',
            'Your suggestion status was updated',
        ];
    }

    /** @return array{0:string,1:string} */
    private function bodies(): array
    {
        $suggestionTitleAr = $this->suggestion->getTranslation('title', 'ar');
        $suggestionTitleEn = $this->suggestion->getTranslation('title', 'en');
        $statusLabelAr = $this->statusLabel('ar');
        $statusLabelEn = $this->statusLabel('en');

        return [
            sprintf('اقتراحك "%s" أصبح: %s', $suggestionTitleAr, $statusLabelAr),
            sprintf('Your suggestion "%s" is now: %s', $suggestionTitleEn, $statusLabelEn),
        ];
    }

    private function statusLabel(string $locale): string
    {
        return match ($this->suggestion->status) {
            SuggestionStatus::UnderReview => $locale === 'ar' ? 'قيد المراجعة' : 'Under review',
            SuggestionStatus::Accepted => $locale === 'ar' ? 'مقبول' : 'Accepted',
            SuggestionStatus::Rejected => $locale === 'ar' ? 'مرفوض' : 'Rejected',
            SuggestionStatus::InProgress => $locale === 'ar' ? 'قيد التنفيذ' : 'In progress',
        };
    }
}
