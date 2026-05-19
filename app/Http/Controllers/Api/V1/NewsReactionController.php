<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ReactionType;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @group News Reactions
 */
class NewsReactionController extends Controller
{
    public function store(Request $request, News $news): JsonResponse
    {
        $data = $request->validate([
            'type' => ['required', Rule::enum(ReactionType::class)],
        ]);

        $news->reactions()->updateOrCreate(
            ['user_id' => $request->user()->id],
            ['type' => $data['type']]
        );

        return response()->json([
            'message' => __('messages.reaction_saved'),
            'counts' => $this->counts($news),
        ]);
    }

    public function destroy(Request $request, News $news): JsonResponse
    {
        $news->reactions()->where('user_id', $request->user()->id)->delete();

        return response()->json([
            'message' => __('messages.reaction_removed'),
            'counts' => $this->counts($news),
        ]);
    }

    private function counts(News $news): array
    {
        return $news->reactions()
            ->selectRaw('type, COUNT(*) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->all();
    }
}
