<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group FAQs
 *
 * APIs for browsing frequently asked questions.
 */
class FaqController extends Controller
{
    /**
     * List FAQs
     *
     * Get all active frequently asked questions ordered by the configured order.
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "question": {"ar": "كيف أنضم للعائلة؟", "en": "How do I join the family?"},
     *       "answer": {"ar": "يمكنك التقديم من خلال...", "en": "You can apply by..."},
     *       "order": 0
     *     }
     *   ]
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $faqs = Faq::active()->orderBy('order')->get();

        return FaqResource::collection($faqs);
    }
}
