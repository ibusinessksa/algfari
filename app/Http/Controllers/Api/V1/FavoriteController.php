<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Favorites
 *
 * APIs for managing favorite members.
 */
class FavoriteController extends Controller
{
    /**
     * List Favorites
     *
     * Get a paginated list of the authenticated user's favorited members.
     *
     * @queryParam per_page integer Items per page. Example: 15
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "full_name": "محمد القحطاني",
     *       "phone_number": "0551234567",
     *       "profile_image": null
     *     }
     *   ],
     *   "links": {"first": "...", "last": "...", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 15, "total": 1}
     * }
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $favorites = $request->user()
            ->favorites()
            ->with('media')
            ->paginate($request->input('per_page', 15));

        return UserResource::collection($favorites);
    }

    /**
     * Add to Favorites
     *
     * Add a member to the authenticated user's favorites.
     *
     * @urlParam member int required The member user id. Example: 1
     *
     * @response 200 {"message": "تمت الإضافة إلى المفضلة بنجاح."}
     * @response 422 {"message": "هذا العضو موجود بالفعل في المفضلة."}
     */
    public function store(Request $request, User $member): JsonResponse
    {
        $user = $request->user();

        if ($user->favorites()->where('favorited_user_id', $member->id)->exists()) {
            return response()->json(['message' => __('messages.already_favorited')], 422);
        }

        $user->favorites()->attach($member->id);

        return response()->json(['message' => __('messages.added_to_favorites')]);
    }

    /**
     * Remove from Favorites
     *
     * Remove a member from the authenticated user's favorites.
     *
     * @urlParam member int required The member user id. Example: 1
     *
     * @response 200 {"message": "تمت الإزالة من المفضلة بنجاح."}
     */
    public function destroy(Request $request, User $member): JsonResponse
    {
        $request->user()->favorites()->detach($member->id);

        return response()->json(['message' => __('messages.removed_from_favorites')]);
    }
}
