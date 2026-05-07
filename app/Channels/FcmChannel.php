<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;

class FcmChannel
{
    public function __construct(private Messaging $messaging) {}

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

        $message = CloudMessage::new()
            ->withNotification(FcmNotification::create(
                $fcmMessage['title'] ?? '',
                $fcmMessage['body'] ?? ''
            ))
            ->withData($fcmMessage['data'] ?? []);

        try {
            $report = $this->messaging->sendMulticast($message, $tokens);

            // Deactivate invalid tokens
            if ($report->hasFailures()) {
                $invalidTokens = [];
                foreach ($report->failures()->getItems() as $failure) {
                    $invalidTokens[] = $failure->target()->value();
                }

                if (!empty($invalidTokens)) {
                    $notifiable->devices()
                        ->whereIn('device_token', $invalidTokens)
                        ->update(['is_active' => false]);
                }
            }
        } catch (\Throwable) {
            // Silent fail — FCM errors should not break the main notification flow
        }
    }
}
