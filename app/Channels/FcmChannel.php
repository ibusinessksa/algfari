<?php

namespace App\Channels;

use App\Services\FcmService;
use Illuminate\Notifications\Notification;

class FcmChannel
{
    public function __construct(private FcmService $fcm) {}

    public function send(mixed $notifiable, Notification $notification): void
    {
        $tokens = $notifiable->devices()
            ->where('is_active', true)
            ->pluck('device_token')
            ->filter()
            ->values()
            ->toArray();

        if (empty($tokens)) {
            return;
        }

        $fcmMessage = $notification->toFcm($notifiable);

        $result = $this->fcm->sendMulticast(
            $tokens,
            $fcmMessage['title'] ?? '',
            $fcmMessage['body'] ?? '',
            $fcmMessage['data'] ?? [],
        );

        if (! empty($result['invalid_tokens'])) {
            $notifiable->devices()
                ->whereIn('device_token', $result['invalid_tokens'])
                ->update(['is_active' => false]);
        }
    }
}
