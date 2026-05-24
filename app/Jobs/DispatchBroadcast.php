<?php

namespace App\Jobs;

use App\Mail\BroadcastMail;
use App\Models\Broadcast;
use App\Models\User;
use App\Services\FcmService;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DispatchBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $broadcastId) {}

    public function handle(SmsService $sms, FcmService $fcm): void
    {
        $broadcast = Broadcast::find($this->broadcastId);
        if (! $broadcast) {
            return;
        }

        $recipients = $this->resolveAudience($broadcast)->get();

        $channels = $broadcast->channels ?: ['email'];

        foreach ($recipients as $user) {
            if (in_array('email', $channels, true) && $user->email) {
                Mail::to($user->email)->queue(
                    new BroadcastMail($broadcast->title, $broadcast->body, $user->full_name ?? '')
                );
            }

            if (in_array('sms', $channels, true) && $user->phone_number) {
                $sms->send($user->phone_number, $broadcast->title . "\n" . $broadcast->body);
            }
        }

        if (in_array('push', $channels, true)) {
            $this->sendPush($broadcast, $recipients->pluck('id')->all(), $fcm);
        }

        $broadcast->update([
            'sent_at' => now(),
            'recipients_count' => $recipients->count(),
        ]);
    }

    private function sendPush(Broadcast $broadcast, array $userIds, FcmService $fcm): void
    {
        if (empty($userIds)) {
            return;
        }

        $tokens = \App\Models\UserDevice::query()
            ->whereIn('user_id', $userIds)
            ->where('is_active', true)
            ->whereNotNull('device_token')
            ->pluck('device_token')
            ->all();

        if (empty($tokens)) {
            return;
        }

        $result = $fcm->sendMulticast(
            $tokens,
            (string) $broadcast->title,
            (string) $broadcast->body,
            ['type' => 'broadcast', 'broadcast_id' => (string) $broadcast->id],
        );

        if (! empty($result['invalid_tokens'])) {
            \App\Models\UserDevice::whereIn('device_token', $result['invalid_tokens'])
                ->update(['is_active' => false]);
        }
    }

    private function resolveAudience(Broadcast $b)
    {
        $query = User::query()->where('status', 'active');
        $filter = $b->audience_filter ?? [];

        return match ($b->audience_type) {
            'region' => $query->where('region_id', $filter['region_id'] ?? 0),
            'family' => $query->where('family_id', $filter['family_id'] ?? 0),
            'role' => $query->where('role', $filter['role'] ?? 'member'),
            default => $query,
        };
    }
}
