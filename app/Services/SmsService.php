<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function send(string $to, string $message): bool
    {
        $driver = config('services.sms.driver', 'log');

        if ($driver === 'unifonic') {
            return $this->sendViaUnifonic($to, $message);
        }

        Log::info('SMS (log driver)', ['to' => $to, 'message' => $message]);
        return true;
    }

    private function sendViaUnifonic(string $to, string $message): bool
    {
        $cfg = config('services.sms.unifonic');
        if (! $cfg['app_sid']) {
            Log::warning('Unifonic SMS skipped: missing app_sid', ['to' => $to]);
            return false;
        }

        $response = Http::asForm()->post($cfg['endpoint'], [
            'AppSid' => $cfg['app_sid'],
            'SenderID' => $cfg['sender_id'],
            'Recipient' => $to,
            'Body' => $message,
        ]);

        return $response->successful();
    }
}
