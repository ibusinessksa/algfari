<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreChildRequest;
use App\Http\Requests\Api\V1\UpdateChildRequest;
use App\Http\Resources\Api\V1\MemberChildResource;
use App\Models\MemberChild;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChildController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $children = MemberChild::query()
            ->where('user_id', $request->user()->id)
            ->with('linkedUser')
            ->orderBy('gender')
            ->orderBy('sort_order')
            ->get();

        return MemberChildResource::collection($children);
    }

    public function store(StoreChildRequest $request): JsonResponse
    {
        $data = $request->validated();
        $memberId = $request->user()->id;

        $sortOrder = MemberChild::where('user_id', $memberId)
            ->where('gender', $data['gender'])
            ->max('sort_order') + 1;

        $child = MemberChild::create([
            'user_id' => $memberId,
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'sort_order' => $sortOrder,
        ]);

        return response()->json([
            'message' => __('messages.created'),
            'data' => new MemberChildResource($child),
        ], 201);
    }

    public function update(UpdateChildRequest $request, MemberChild $child): JsonResponse
    {
        abort_unless($child->user_id === $request->user()->id, 403);

        $data = $request->validated();

        if (isset($data['gender']) && $data['gender'] !== $child->gender) {
            $data['sort_order'] = MemberChild::where('user_id', $child->user_id)
                ->where('gender', $data['gender'])
                ->max('sort_order') + 1;
        }

        $child->update($data);

        return response()->json([
            'message' => __('messages.updated'),
            'data' => new MemberChildResource($child->fresh('linkedUser')),
        ]);
    }

    public function destroy(Request $request, MemberChild $child): JsonResponse
    {
        abort_unless($child->user_id === $request->user()->id, 403);

        $child->delete();

        return response()->json(['message' => __('messages.deleted')]);
    }
}
