<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Notifications
 *
 * APIs for managing user notifications.
 */
class NotificationController extends Controller
{
    /**
     * List Notifications
     *
     * Get a paginated list of the authenticated user's notifications.
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": "b8c9d0e1-2345-6f78-a901-234567890bcd",
     *       "title": "خبر جديد: اجتماع مجلس العائلة",
     *       "body": "تم نشر خبر جديد بعنوان اجتماع مجلس العائلة السنوي",
     *       "type": "news",
     *       "is_read": false,
     *       "created_at": "2026-04-13T10:00:00.000000Z"
     *     },
     *     {
     *       "id": "c9d0e1f2-3456-7a89-b012-345678901cde",
     *       "title": "فعالية جديدة: حفل زفاف",
     *       "body": "تم إنشاء فعالية جديدة بعنوان حفل زفاف آل محمد",
     *       "type": "event",
     *       "is_read": true,
     *       "created_at": "2026-04-12T14:30:00.000000Z"
     *     }
     *   ],
     *   "current_page": 1,
     *   "last_page": 1,
     *   "per_page": 20,
     *   "total": 2
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $locale = app()->getLocale();

        $notifications = $request->user()
            ->notifications()
            ->paginate(20);

        $notifications->getCollection()->transform(function ($n) use ($locale) {
            return [
                'id' => $n->id,
                'title' => $n->data['title'][$locale] ?? $n->data['title']['ar'] ?? '',
                'body' => $n->data['body'][$locale] ?? $n->data['body']['ar'] ?? '',
                'type' => $n->data['type'] ?? null,
                'is_read' => !is_null($n->read_at),
                'created_at' => $n->created_at->toISOString(),
            ];
        });

        return response()->json($notifications);
    }

    /**
     * Mark Notification as Read
     *
     * Mark a single notification as read.
     *
     * @urlParam id string required The notification UUID. Example: 9a8b7c6d-1234-5678-abcd-ef0123456789
     *
     * @response 200 {"message": "تم قراءة الإشعار"}
     * @response 404 {"message": "غير موجود"}
     */
    public function markAsRead(Request $request, string $id): JsonResponse
    {
        $notification = $request->user()
            ->notifications()
            ->where('id', $id)
            ->first();

        if (!$notification) {
            return response()->json(['message' => __('messages.not_found')], 404);
        }

        $notification->markAsRead();

        return response()->json(['message' => __('messages.notification_read')]);
    }

    /**
     * Mark All Notifications as Read
     *
     * Mark all unread notifications as read for the authenticated user.
     *
     * @response 200 {"message": "تم قراءة جميع الإشعارات"}
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => __('messages.all_notifications_read')]);
    }
}
