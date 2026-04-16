<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewEventCreated extends Notification
{
    use Queueable;

    public function __construct(private Event $event) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => [
                'ar' => 'مناسبة جديدة: ' . ($this->event->getTranslation('title', 'ar') ?? ''),
                'en' => 'New event: ' . ($this->event->getTranslation('title', 'en') ?? ''),
            ],
            'body' => [
                'ar' => 'تم إضافة مناسبة جديدة بتاريخ ' . $this->event->event_date->format('Y-m-d'),
                'en' => 'A new event has been added on ' . $this->event->event_date->format('Y-m-d'),
            ],
            'type' => 'new_event',
            'event_id' => $this->event->id,
        ];
    }
}
