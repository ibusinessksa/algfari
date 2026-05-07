<?php

namespace App\Notifications;

use App\Channels\FcmChannel;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewEventCreated extends Notification
{
    use Queueable;

    public function __construct(private Event $event) {}

    public function via(mixed $_notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toArray(mixed $_notifiable): array
    {
        $titleAr = 'مناسبة جديدة: ' . ($this->event->getTranslation('title', 'ar') ?? '');
        $titleEn = 'New event: ' . ($this->event->getTranslation('title', 'en') ?? '');
        $bodyAr  = 'تم إضافة مناسبة جديدة بتاريخ ' . $this->event->event_date->format('Y-m-d');
        $bodyEn  = 'A new event has been added on ' . $this->event->event_date->format('Y-m-d');

        return [
            'title'    => ['ar' => $titleAr, 'en' => $titleEn],
            'body'     => ['ar' => $bodyAr, 'en' => $bodyEn],
            'type'     => 'new_event',
            'event_id' => $this->event->id,
        ];
    }

    public function toFcm(mixed $_notifiable): array
    {
        $titleAr = 'مناسبة جديدة: ' . ($this->event->getTranslation('title', 'ar') ?? '');
        $titleEn = 'New event: ' . ($this->event->getTranslation('title', 'en') ?? '');
        $bodyAr  = 'تم إضافة مناسبة جديدة بتاريخ ' . $this->event->event_date->format('Y-m-d');
        $bodyEn  = 'A new event has been added on ' . $this->event->event_date->format('Y-m-d');

        return [
            'title' => $titleAr,
            'body'  => $bodyAr,
            'data'  => [
                'type'     => 'new_event',
                'event_id' => (string) $this->event->id,
                'title_ar' => $titleAr,
                'title_en' => $titleEn,
                'body_ar'  => $bodyAr,
                'body_en'  => $bodyEn,
            ],
        ];
    }
}
