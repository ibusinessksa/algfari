<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\FcmService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestFcmController extends Controller
{
    public function __construct(private FcmService $fcm) {}

    public function send(Request $request): JsonResponse
    {
        $request->validate([
            'fcm_token' => ['required', 'string'],
            'title'     => ['nullable', 'string'],
            'body'      => ['nullable', 'string'],
        ]);

        try {
            $sent = $this->fcm->send(
                (string) $request->input('fcm_token'),
                $request->input('title', 'Test Notification'),
                $request->input('body', 'This is a test message from the server.'),
                ['type' => 'test'],
            );

            if (! $sent) {
                return response()->json(['message' => 'Failed to send notification.'], 500);
            }

            return response()->json(['message' => 'Notification sent successfully.']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to send notification.', 'error' => $e->getMessage()], 500);
        }
    }
}
