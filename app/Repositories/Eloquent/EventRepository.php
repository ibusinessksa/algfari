<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventRepository implements EventRepositoryInterface
{
    public function paginateActive(array $filters, int $perPage): LengthAwarePaginator
    {
        return Event::query()
            ->with(['creator', 'media'])
            ->withCount('attendees')
            ->when($filters['event_type'] ?? null, fn ($q, $v) => $q->where('event_type', $v))
            ->when(! empty($filters['upcoming']), fn ($q) => $q->where('event_date', '>', now()))
            ->where('is_active', true)
            ->latest('event_date')
            ->paginate($perPage);
    }

    public function loadDetailWithCounts(Event $event): Event
    {
        return $event->load(['creator', 'media'])->loadCount('attendees');
    }
}
