<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\FamilyFundTransaction;
use App\Models\News;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => ['required', 'string', 'min:1'],
            'per_type_limit' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $keyword = trim($validated['q']);
        $like = '%'.$keyword.'%';
        $perTypeLimit = (int) ($validated['per_type_limit'] ?? 5);

        $results = collect()
            ->concat($this->searchEvents($like, $perTypeLimit))
            ->concat($this->searchOffers($like, $perTypeLimit))
            ->concat($this->searchNews($like, $perTypeLimit))
            ->concat($this->searchFundTransactions($like, $perTypeLimit))
            ->concat($this->searchMembers($like, $perTypeLimit))
            ->sortByDesc('created_at')
            ->values()
            ->map(fn (array $item) => [
                'type' => $item['type'],
                'navigation_id' => $item['navigation_id'],
                'title' => $item['title'],
            ]);

        return response()->json([
            'data' => $results,
        ]);
    }

    private function searchEvents(string $like, int $limit): array
    {
        return Event::query()
            ->where('is_active', true)
            ->where(function ($query) use ($like) {
                $query->whereRaw("JSON_EXTRACT(title, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(description, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(description, '$.en') LIKE ?", [$like]);
            })
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (Event $event) => [
                'type' => 'event',
                'navigation_id' => $event->id,
                'title' => $event->getTranslations('title'),
                'created_at' => $event->created_at,
            ])
            ->all();
    }

    private function searchOffers(string $like, int $limit): array
    {
        return Offer::query()
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->where(function ($query) use ($like) {
                $query->whereRaw("JSON_EXTRACT(title, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(description, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(description, '$.en') LIKE ?", [$like]);
            })
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (Offer $offer) => [
                'type' => 'offer',
                'navigation_id' => $offer->id,
                'title' => $offer->getTranslations('title'),
                'created_at' => $offer->created_at,
            ])
            ->all();
    }

    private function searchNews(string $like, int $limit): array
    {
        return News::query()
            ->whereNotNull('published_at')
            ->where(function ($query) use ($like) {
                $query->whereRaw("JSON_EXTRACT(title, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(content, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(content, '$.en') LIKE ?", [$like]);
            })
            ->latest('published_at')
            ->limit($limit)
            ->get()
            ->map(fn (News $news) => [
                'type' => 'new',
                'navigation_id' => $news->id,
                'title' => $news->getTranslations('title'),
                'created_at' => $news->created_at,
            ])
            ->all();
    }

    private function searchFundTransactions(string $like, int $limit): array
    {
        return FamilyFundTransaction::query()
            ->where('status', 'approved')
            ->where(function ($query) use ($like) {
                $query->whereRaw("JSON_EXTRACT(description, '$.ar') LIKE ?", [$like])
                    ->orWhereRaw("JSON_EXTRACT(description, '$.en') LIKE ?", [$like]);
            })
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (FamilyFundTransaction $transaction) => [
                'type' => 'family_fund',
                'navigation_id' => $transaction->id,
                'title' => $transaction->getTranslations('description'),
                'created_at' => $transaction->created_at,
            ])
            ->all();
    }

    private function searchMembers(string $like, int $limit): array
    {
        return User::query()
            ->where('status', 'active')
            ->where(function ($query) use ($like) {
                $query->where('full_name', 'like', $like)
                    ->orWhere('phone_number', 'like', $like);
            })
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (User $member) => [
                'type' => 'member',
                'navigation_id' => $member->id,
                'title' => [
                    'ar' => $member->full_name ?? '',
                    'en' => '',
                ],
                'created_at' => $member->created_at,
            ])
            ->all();
    }
}
