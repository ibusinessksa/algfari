<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Locations
 *
 * Reference data for countries / regions / cities (read-only).
 */
class RegionController extends Controller
{
    /**
     * List Regions
     *
     * Paginated regions. Filter by `country_id` or search in localized names (Arabic / English).
     *
     * @unauthenticated
     *
     * @queryParam country_id int Filter by country. Example: 1
     * @queryParam search string Search in region name (both locales). Example: الرياض
     * @queryParam per_page int Items per page (1–100). Example: 50
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "country_id": 1,
     *       "name": {"ar": "منطقة الرياض", "en": "Riyadh Region"},
     *       "cities_count": 12,
     *       "country": {"id": 1, "code": "SA", "name": {"ar": "المملكة العربية السعودية", "en": "Saudi Arabia"}},
     *       "created_at": "2026-04-17T10:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/regions?page=1", "last": "http://algfari.test/api/v1/regions?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 50, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'country_id' => ['sometimes', 'integer', 'exists:countries,id'],
            'search' => ['sometimes', 'string', 'max:255'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        $locale = in_array(app()->getLocale(), ['ar', 'en'], true) ? app()->getLocale() : 'ar';

        $regions = Region::query()
            ->with('country')
            ->withCount('cities')
            ->when($request->filled('country_id'), fn ($q) => $q->where('country_id', $request->integer('country_id')))
            ->when($request->filled('search'), function ($q) use ($request) {
                $needle = $request->input('search');
                $q->where(function ($query) use ($needle) {
                    foreach (['ar', 'en'] as $loc) {
                        $query->orWhere("name->{$loc}", 'like', '%'.$needle.'%');
                    }
                });
            })
            ->orderBy('country_id')
            ->orderBy('name->'.$locale)
            ->paginate($request->integer('per_page', 50));

        return RegionResource::collection($regions);
    }
}
