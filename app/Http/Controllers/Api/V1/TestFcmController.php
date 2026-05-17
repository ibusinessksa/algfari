<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;

class TestFcmController extends Controller
{
    public function __construct(private Messaging $messaging) {}

    public function send(Request $request): JsonResponse
    {
        $request->validate([
            'fcm_token' => ['required', 'string'],
            'title'     => ['nullable', 'string'],
            'body'      => ['nullable', 'string'],
        ]);

        $message = CloudMessage::withTarget('token', $request->fcm_token)
            ->withNotification(FcmNotification::create(
                $request->input('title', 'Test Notification'),
                $request->input('body', 'This is a test message from the server.')
            ))
            ->withData(['type' => 'test']);

        try {
            $this->messaging->send($message);

            return response()->json(['message' => 'Notification sent successfully.']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to send notification.', 'error' => $e->getMessage()], 500);
        }
    }
}
