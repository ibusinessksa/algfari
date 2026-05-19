<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\NewsCommentStatus;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @group News Comments
 */
class NewsCommentController extends Controller
{
    public function index(Request $request, News $news): AnonymousResourceCollection
    {
        $comments = $news->approvedComments()
            ->with('user:id,full_name')
            ->latest()
            ->paginate($request->input('per_page', 15));

        return JsonResource::collection($comments);
    }

    public function store(Request $request, News $news): JsonResponse
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        $comment = $news->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $data['content'],
            'status' => NewsCommentStatus::Approved,
        ]);

        return response()->json([
            'message' => __('messages.comment_added'),
            'comment' => $comment->load('user:id,full_name'),
        ], 201);
    }

    public function destroy(Request $request, News $news, NewsComment $comment): JsonResponse
    {
        abort_unless(
            $comment->user_id === $request->user()->id
                || $request->user()->role === \App\Enums\UserRole::Admin,
            403
        );

        $comment->delete();

        return response()->json(['message' => __('messages.deleted')]);
    }
}
