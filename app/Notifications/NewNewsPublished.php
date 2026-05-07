<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewNewsPublished extends Notification
{
    use Queueable;

    public function __construct(private News $news) {}

    public function via(mixed $_notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(mixed $_notifiable): array
    {
        [$titleAr, $titleEn, $bodyAr, $bodyEn] = $this->buildPayload();

        return [
            'title'   => ['ar' => $titleAr, 'en' => $titleEn],
            'body'    => ['ar' => $bodyAr, 'en' => $bodyEn],
            'type'    => 'new_news',
            'news_id' => $this->news->id,
        ];
    }

    public function toFcm(mixed $_notifiable): array
    {
        [$titleAr, $titleEn, $bodyAr, $bodyEn] = $this->buildPayload();

        return [
            'title' => $titleAr,
            'body'  => $bodyAr,
            'data'  => [
                'type'     => 'new_news',
                'news_id'  => (string) $this->news->id,
                'title_ar' => $titleAr,
                'title_en' => $titleEn,
                'body_ar'  => $bodyAr,
                'body_en'  => $bodyEn,
            ],
        ];
    }

    private function buildPayload(): array
    {
        $arContent = $this->news->getTranslation('content', 'ar');
        $enContent = $this->news->getTranslation('content', 'en');

        return [
            'خبر جديد: ' . ($this->news->getTranslation('title', 'ar') ?? ''),
            'New news: ' . ($this->news->getTranslation('title', 'en') ?? ''),
            Str::limit(strip_tags($arContent ?? ''), 200) ?: 'تم نشر خبر جديد، اطلع عليه الآن.',
            Str::limit(strip_tags($enContent ?? ''), 200) ?: 'A new article has been published. Check it out.',
        ];
    }
}
