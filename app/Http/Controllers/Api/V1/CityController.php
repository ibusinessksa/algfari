<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Locations
 *
 * Reference data for cities (read-only).
 */
class CityController extends Controller
{
    /**
     * List Cities
     *
     * Paginated cities. Filter by `region_id` and/or `country_id`, or search in localized names.
     *
     * @unauthenticated
     *
     * @queryParam region_id int Filter by region. Example: 3
     * @queryParam country_id int Filter by country (via region). Example: 1
     * @queryParam search string Search in city name (both locales). Example: الرياض
     * @queryParam per_page int Items per page (1–100). Example: 50
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "region_id": 1,
     *       "name": {"ar": "الرياض", "en": "Riyadh"},
     *       "region": {
     *         "id": 1,
     *         "country_id": 1,
     *         "name": {"ar": "منطقة الرياض", "en": "Riyadh Region"},
     *         "country": {"id": 1, "code": "SA", "name": {"ar": "المملكة العربية السعودية", "en": "Saudi Arabia"}}
     *       },
     *       "created_at": "2026-04-17T10:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/cities?page=1", "last": "http://algfari.test/api/v1/cities?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 50, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'region_id' => ['sometimes', 'integer', 'exists:regions,id'],
            'country_id' => ['sometimes', 'integer', 'exists:countries,id'],
            'search' => ['sometimes', 'string', 'max:255'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        $locale = in_array(app()->getLocale(), ['ar', 'en'], true) ? app()->getLocale() : 'ar';

        $cities = City::query()
            ->with(['region.country'])
            ->when($request->filled('region_id'), fn ($q) => $q->where('region_id', $request->integer('region_id')))
            ->when($request->filled('country_id'), function ($q) use ($request) {
                $q->whereHas('region', fn ($rq) => $rq->where('country_id', $request->integer('country_id')));
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $needle = $request->input('search');
                $q->where(function ($query) use ($needle) {
                    foreach (['ar', 'en'] as $loc) {
                        $query->orWhere("name->{$loc}", 'like', '%'.$needle.'%');
                    }
                });
            })
            ->orderBy('region_id')
            ->orderBy('name->'.$locale)
            ->paginate($request->integer('per_page', 50));

        return CityResource::collection($cities);
    }
}
