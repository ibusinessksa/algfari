<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Offers
 *
 * APIs for browsing member offers and services.
 */
class OfferController extends Controller
{
    /**
     * List Offers
     *
     * Get a paginated list of active, non-expired offers.
     *
     * @queryParam category string Filter by category (commercial/contractor). Example: commercial
     * @queryParam per_page integer Items per page. Example: 15
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": "d4e5f6a7-8901-2bcd-ef34-567890123cde",
     *       "title": "خدمة صيانة المكيفات",
     *       "description": "صيانة وتركيب جميع أنواع المكيفات بأسعار مخفضة لأبناء القبيلة",
     *       "category": "contractor",
     *       "service_address": "الرياض - حي النسيم",
     *       "contact_phone": "0559876543",
     *       "contact_whatsapp": "0559876543",
     *       "is_active": true,
     *       "expires_at": "2026-06-01T00:00:00.000000Z",
     *       "offered_by": {
     *         "id": "9a8b7c6d-1234-5678-abcd-ef0123456789",
     *         "full_name": "خالد العتيبي"
     *       },
     *       "offer_image": "http://algfari.test/storage/media/15/offer.jpg",
     *       "created_at": "2026-04-01T10:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/offers?page=1", "last": "http://algfari.test/api/v1/offers?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 15, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $offers = Offer::query()
            ->with(['offeredBy', 'media'])
            ->where('is_active', true)
            ->when($request->category, fn ($q, $v) => $q->where('category', $v))
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->paginate($request->input('per_page', 15));

        return OfferResource::collection($offers);
    }

    /**
     * Offer Details
     *
     * Get details of a specific offer.
     *
     * @urlParam offer string required The offer UUID. Example: 9a8b7c6d-1234-5678-abcd-ef0123456789
     *
     * @response 200 scenario="success" {
     *   "data": {
     *     "id": "d4e5f6a7-8901-2bcd-ef34-567890123cde",
     *     "title": "خدمة صيانة المكيفات",
     *     "description": "صيانة وتركيب جميع أنواع المكيفات بأسعار مخفضة لأبناء القبيلة. نوفر خدمة منزلية.",
     *     "category": "contractor",
     *     "service_address": "الرياض - حي النسيم",
     *     "contact_phone": "0559876543",
     *     "contact_whatsapp": "0559876543",
     *     "is_active": true,
     *     "expires_at": "2026-06-01T00:00:00.000000Z",
     *     "offered_by": {
     *       "id": "9a8b7c6d-1234-5678-abcd-ef0123456789",
     *       "full_name": "خالد العتيبي"
     *     },
     *     "offer_image": "http://algfari.test/storage/media/15/offer.jpg",
     *     "gallery": [
     *       "http://algfari.test/storage/media/16/gallery1.jpg",
     *       "http://algfari.test/storage/media/17/gallery2.jpg"
     *     ],
     *     "created_at": "2026-04-01T10:00:00.000000Z"
     *   }
     * }
     */
    public function show(Offer $offer): OfferResource
    {
        $offer->load(['offeredBy', 'media']);

        return new OfferResource($offer);
    }
}
