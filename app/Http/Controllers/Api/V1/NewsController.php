<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group News
 *
 * APIs for browsing family/tribe news.
 */
class NewsController extends Controller
{
    /**
     * List News
     *
     * Get a paginated list of published news articles. Urgent items appear first.
     *
     * @queryParam search string Search in title and content (Arabic and English). Example: اجتماع
     * @queryParam per_page integer Items per page. Example: 15
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": {"ar": "اجتماع مجلس العائلة السنوي", "en": "Annual family council meeting"},
     *       "content": {"ar": "تفاصيل الخبر...", "en": "Full article..."},
     *       "is_urgent": false,
     *       "published_at": "2026-04-10T08:00:00.000000Z",
     *       "time_from": "10:00:00",
     *       "time_to": "14:00:00",
     *       "cover_image": "http://algfari.test/storage/media/5/cover.jpg",
     *       "cover_image_medium": "http://algfari.test/storage/media/5/conversions/cover-medium.jpg",
     *       "cover_image_thumb": "http://algfari.test/storage/media/5/conversions/cover-thumb.jpg",
     *       "gallery": [{"url": "...", "medium": "...", "thumb": "..."}],
     *       "created_at": "2026-04-10T08:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/news?page=1", "last": "http://algfari.test/api/v1/news?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 15, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $news = News::query()
            ->with('media')
            ->whereNotNull('published_at')
            ->when($request->search, function ($q, string $v) {
                $like = '%'.$v.'%';
                $q->where(function ($q) use ($like) {
                    $q->whereRaw("JSON_EXTRACT(title, '$.ar') LIKE ?", [$like])
                        ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", [$like])
                        ->orWhereRaw("JSON_EXTRACT(content, '$.ar') LIKE ?", [$like])
                        ->orWhereRaw("JSON_EXTRACT(content, '$.en') LIKE ?", [$like]);
                });
            })
            ->orderByDesc('is_urgent')
            ->latest('published_at')
            ->paginate($request->input('per_page', 15));

        return NewsResource::collection($news);
    }

    /**
     * News Details
     *
     * Get details of a specific news article.
     *
     * @urlParam news integer required The news ID. Example: 1
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "id": 1,
     *     "title": {"ar": "اجتماع مجلس العائلة السنوي", "en": "Annual family council meeting"},
     *     "content": {"ar": "نص الخبر الكامل...", "en": "Full article text..."},
     *     "is_urgent": true,
     *     "published_at": "2026-04-10T08:00:00.000000Z",
     *     "time_from": "10:00:00",
     *     "time_to": "14:00:00",
     *     "cover_image": "http://algfari.test/storage/media/5/cover.jpg",
     *     "cover_image_medium": "http://algfari.test/storage/media/5/conversions/cover-medium.jpg",
     *     "cover_image_thumb": "http://algfari.test/storage/media/5/conversions/cover-thumb.jpg",
     *     "gallery": [
     *       {"url": "http://algfari.test/storage/media/6/photo1.jpg", "medium": "...", "thumb": "..."}
     *     ],
     *     "created_at": "2026-04-10T08:00:00.000000Z"
     *   }
     * }
     */
    public function show(News $news): NewsResource
    {
        $news->load('media');

        return new NewsResource($news);
    }
}
