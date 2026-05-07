<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOfferPublished extends Notification
{
    use Queueable;

    private const BODY_AR = 'تم نشر عرض جديد، اطلع عليه الآن.';
    private const BODY_EN = 'A new offer has been published. Check it out.';

    public function __construct(private Offer $offer) {}

    public function via(mixed $_notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(mixed $_notifiable): array
    {
        $titleAr = 'عرض جديد: ' . ($this->offer->getTranslation('title', 'ar') ?? '');
        $titleEn = 'New offer: ' . ($this->offer->getTranslation('title', 'en') ?? '');

        return [
            'title'    => ['ar' => $titleAr, 'en' => $titleEn],
            'body'     => ['ar' => self::BODY_AR, 'en' => self::BODY_EN],
            'type'     => 'new_offer',
            'offer_id' => $this->offer->id,
        ];
    }

    public function toFcm(mixed $_notifiable): array
    {
        $titleAr = 'عرض جديد: ' . ($this->offer->getTranslation('title', 'ar') ?? '');
        $titleEn = 'New offer: ' . ($this->offer->getTranslation('title', 'en') ?? '');

        return [
            'title' => $titleAr,
            'body'  => self::BODY_AR,
            'data'  => [
                'type'     => 'new_offer',
                'offer_id' => (string) $this->offer->id,
                'title_ar' => $titleAr,
                'title_en' => $titleEn,
                'body_ar'  => self::BODY_AR,
                'body_en'  => self::BODY_EN,
            ],
        ];
    }
}
