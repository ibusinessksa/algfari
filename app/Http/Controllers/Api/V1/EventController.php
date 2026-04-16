<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\RsvpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RsvpRequest;
use App\Http\Resources\Api\V1\EventResource;
use App\Models\Event;
use App\Models\EventAttendee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Events
 *
 * APIs for browsing events and managing RSVPs.
 */
class EventController extends Controller
{
    /**
     * List Events
     *
     * Get a paginated list of active events.
     *
     * @queryParam event_type string Filter by type (wedding/death/other). Example: wedding
     * @queryParam upcoming boolean Show only upcoming events. Example: 1
     * @queryParam per_page integer Items per page. Example: 15
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": "c3d4e5f6-7890-1abc-def2-345678901bcd",
     *       "title": "حفل زفاف آل محمد",
     *       "description": "حفل زفاف الأخ محمد بن عبدالله، يسعدنا دعوتكم للحضور.",
     *       "event_type": "wedding",
     *       "event_date": "2026-05-01T18:00:00.000000Z",
     *       "end_date": "2026-05-01T23:00:00.000000Z",
     *       "location_name": "قاعة الأمير سلطان - الرياض",
     *       "location_lat": "24.71370000",
     *       "location_lng": "46.67530000",
     *       "is_active": true,
     *       "attendees_count": 45,
     *       "creator": {
     *         "id": "9a8b7c6d-1234-5678-abcd-ef0123456789",
     *         "full_name": "عبدالله القحطاني"
     *       },
     *       "cover_image": "http://algfari.test/storage/media/10/event-cover.jpg",
     *       "created_at": "2026-04-05T12:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/events?page=1", "last": "http://algfari.test/api/v1/events?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 15, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $events = Event::query()
            ->with(['creator', 'media'])
            ->withCount('attendees')
            ->when($request->event_type, fn ($q, $v) => $q->where('event_type', $v))
            ->when($request->boolean('upcoming'), fn ($q) => $q->where('event_date', '>', now()))
            ->where('is_active', true)
            ->latest('event_date')
            ->paginate($request->input('per_page', 15));

        return EventResource::collection($events);
    }

    /**
     * Event Details
     *
     * Get details of a specific event with attendee count.
     *
     * @urlParam event string required The event UUID. Example: 9a8b7c6d-1234-5678-abcd-ef0123456789
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "id": "c3d4e5f6-7890-1abc-def2-345678901bcd",
     *     "title": "حفل زفاف آل محمد",
     *     "description": "حفل زفاف الأخ محمد بن عبدالله، يسعدنا دعوتكم للحضور والمشاركة في هذه المناسبة السعيدة.",
     *     "event_type": "wedding",
     *     "event_date": "2026-05-01T18:00:00.000000Z",
     *     "end_date": "2026-05-01T23:00:00.000000Z",
     *     "location_name": "قاعة الأمير سلطان - الرياض",
     *     "location_lat": "24.71370000",
     *     "location_lng": "46.67530000",
     *     "is_active": true,
     *     "attendees_count": 45,
     *     "creator": {
     *       "id": "9a8b7c6d-1234-5678-abcd-ef0123456789",
     *       "full_name": "عبدالله القحطاني"
     *     },
     *     "cover_image": "http://algfari.test/storage/media/10/event-cover.jpg",
     *     "created_at": "2026-04-05T12:00:00.000000Z"
     *   }
     * }
     */
    public function show(Event $event): EventResource
    {
        $event->load(['creator', 'media'])->loadCount('attendees');

        return new EventResource($event);
    }

    /**
     * RSVP to Event
     *
     * Submit or update your RSVP status for an event.
     *
     * @urlParam event string required The event UUID. Example: 9a8b7c6d-1234-5678-abcd-ef0123456789
     * @bodyParam status string required RSVP status (going/maybe/declined). Example: going
     *
     * @response 200 {"message": "تم تحديث الحضور"}
     */
    public function rsvp(RsvpRequest $request, Event $event): JsonResponse
    {
        EventAttendee::updateOrCreate(
            [
                'event_id' => $event->id,
                'user_id' => $request->user()->id,
            ],
            [
                'rsvp_status' => RsvpStatus::from($request->status),
            ]
        );

        return response()->json(['message' => __('messages.rsvp_updated')]);
    }
}
