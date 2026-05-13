<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreChildRequest;
use App\Http\Resources\Api\V1\MemberChildResource;
use App\Models\MemberChild;
use Illuminate\Http\JsonResponse;

class ChildController extends Controller
{
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
}
