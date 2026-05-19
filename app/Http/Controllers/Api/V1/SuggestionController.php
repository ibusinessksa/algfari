<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\SuggestionStatus;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSuggestionRequest;
use App\Models\Suggestion;
use App\Models\User;
use App\Notifications\AdminSuggestionSubmitted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @bodyParam name string Full name (defaults to authenticated user's name). Example: تميم القفاري
     * @bodyParam email string Email (defaults to authenticated user's email). Example: user@example.com
     * @bodyParam suggestion string required The suggestion text. Example: يمكنك أن تكتب هنا مقترحاتك
     *
     * @response 201 scenario="success" {
     *   "message": "تم تقديم الاقتراح بنجاح",
     *   "suggestion": {
     *     "id": 1,
     *     "name": "تميم القفاري",
     *     "email": "user@example.com",
     *     "suggestion": "يمكنك أن تكتب هنا مقترحاتك",
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
    /**
     * List My Suggestions
     *
     * Get a paginated list of the authenticated user's submitted suggestions, optionally filtered by status.
     *
     * @queryParam status string Filter by status. Allowed values: under_review, accepted, rejected, in_progress. Example: under_review
     * @queryParam per_page integer Items per page (default 20). Example: 20
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "تميم القفاري",
     *       "email": "user@example.com",
     *       "suggestion": "يمكنك أن تكتب هنا مقترحاتك",
     *       "status": "under_review",
     *       "admin_response": null,
     *       "reviewed_at": null,
     *       "created_at": "2026-05-17T10:00:00.000000Z"
     *     }
     *   ],
     *   "current_page": 1,
     *   "last_page": 1,
     *   "per_page": 20,
     *   "total": 1
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['nullable', Rule::enum(SuggestionStatus::class)],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $suggestions = Suggestion::query()
            ->where('submitted_by', $request->user()->id)
            ->when($validated['status'] ?? null, fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate($validated['per_page'] ?? 20);

        return response()->json($suggestions);
    }

    public function store(StoreSuggestionRequest $request): JsonResponse
    {
        $user = $request->user();

        $suggestion = Suggestion::create([
            'name' => $request->input('name') ?: $user->name,
            'email' => $request->input('email') ?: $user->email,
            'suggestion' => $request->string('suggestion')->toString(),
            'submitted_by' => $user->id,
        ]);

        User::query()
            ->where('role', UserRole::Admin)
            ->where('status', UserStatus::Active)
            ->each(fn (User $admin) => $admin->notify(new AdminSuggestionSubmitted($suggestion)));

        return response()->json([
            'message' => __('messages.suggestion_submitted'),
            'suggestion' => $suggestion,
        ], 201);
    }
}
