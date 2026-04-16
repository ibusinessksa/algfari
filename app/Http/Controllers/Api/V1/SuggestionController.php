<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSuggestionRequest;
use App\Models\Suggestion;
use Illuminate\Http\JsonResponse;

/**
 * @group Suggestions
 *
 * APIs for submitting member suggestions.
 */
class SuggestionController extends Controller
{
    /**
     * Submit Suggestion
     *
     * Submit a new suggestion to the administration.
     *
     * @bodyParam title object required Title in Arabic and English. Example: {"ar": "اقتراح جديد", "en": "New suggestion"}
     * @bodyParam title.ar string required Title in Arabic. Example: اقتراح جديد
     * @bodyParam title.en string required Title in English. Example: New suggestion
     * @bodyParam description object required Description in Arabic and English. Example: {"ar": "وصف الاقتراح", "en": "Suggestion description"}
     * @bodyParam description.ar string required Description in Arabic. Example: وصف الاقتراح
     * @bodyParam description.en string required Description in English. Example: Suggestion description
     *
     * @response 201 scenario="success" {
     *   "message": "تم تقديم الاقتراح بنجاح",
     *   "suggestion": {
     *     "id": 1,
     *     "title": {"ar": "اقتراح جديد", "en": "New suggestion"},
     *     "description": {"ar": "وصف الاقتراح", "en": "Suggestion description"},
     *     "submitted_by": 1,
     *     "status": "pending",
     *     "created_at": "2026-04-13T10:00:00.000000Z",
     *     "updated_at": "2026-04-13T10:00:00.000000Z"
     *   }
     * }
     * @response 422 scenario="validation error" {
     *   "message": "The given data was invalid.",
     *   "errors": {"title": ["The title field is required."]}
     * }
     */
    public function store(StoreSuggestionRequest $request): JsonResponse
    {
        $suggestion = Suggestion::create([
            'title' => $request->title,
            'description' => $request->description,
            'submitted_by' => $request->user()->id,
        ]);

        return response()->json([
            'message' => __('messages.suggestion_submitted'),
            'suggestion' => $suggestion,
        ], 201);
    }
}
