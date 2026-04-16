<?php

namespace App\Notifications;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewNewsPublished extends Notification
{
    use Queueable;

    public function __construct(private News $news) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        $arContent = $this->news->getTranslation('content', 'ar');
        $enContent = $this->news->getTranslation('content', 'en');

        return [
            'title' => [
                'ar' => 'خبر جديد: '.($this->news->getTranslation('title', 'ar') ?? ''),
                'en' => 'New news: '.($this->news->getTranslation('title', 'en') ?? ''),
            ],
            'body' => [
                'ar' => Str::limit(strip_tags($arContent ?? ''), 200) ?: 'تم نشر خبر جديد، اطلع عليه الآن.',
                'en' => Str::limit(strip_tags($enContent ?? ''), 200) ?: 'A new article has been published. Check it out.',
            ],
            'type' => 'new_news',
            'news_id' => $this->news->id,
        ];
    }
}
