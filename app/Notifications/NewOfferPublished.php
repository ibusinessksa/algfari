<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOfferPublished extends Notification
{
    use Queueable;

    public function __construct(private Offer $offer) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => [
                'ar' => 'عرض جديد: ' . ($this->offer->getTranslation('title', 'ar') ?? ''),
                'en' => 'New offer: ' . ($this->offer->getTranslation('title', 'en') ?? ''),
            ],
            'body' => [
                'ar' => 'تم نشر عرض جديد، اطلع عليه الآن.',
                'en' => 'A new offer has been published. Check it out.',
            ],
            'type' => 'new_offer',
            'offer_id' => $this->offer->id,
        ];
    }
}
