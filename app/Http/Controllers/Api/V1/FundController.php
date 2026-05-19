<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSupportRequest;
use App\Http\Resources\Api\V1\FundInitiativeResource;
use App\Http\Resources\Api\V1\FundProfileResource;
use App\Http\Resources\Api\V1\FundTransactionResource;
use App\Http\Resources\Api\V1\SupportRequestResource;
use App\Models\FamilyFundTransaction;
use App\Models\FundInitiative;
use App\Models\FundProfile;
use App\Models\SupportRequest;
use App\Models\User;
use App\Notifications\AdminSupportRequestSubmitted;
use App\Services\FundService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Family Fund
 *
 * APIs for the family fund: profile content, initiatives, transactions, support requests.
 */
class FundController extends Controller
{
    public function __construct(private FundService $fundService) {}

    /**
     * List Transactions
     *
     * @queryParam type string Filter by transaction type (donation/expense).
     * @queryParam per_page integer Items per page.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $transactions = FamilyFundTransaction::query()
            ->with(['contributor', 'media'])
            ->where('status', 'approved')
            ->when($request->type, fn ($q, $v) => $q->where('transaction_type', $v))
            ->latest()
            ->paginate($request->input('per_page', 15));

        return FundTransactionResource::collection($transactions);
    }

    /**
     * Fund Summary
     */
    public function summary(): JsonResponse
    {
        return response()->json($this->fundService->getSummary());
    }

    /**
     * Fund Profile
     *
     * Returns the fund's about/vision/mission/goals static content.
     */
    public function profile(): FundProfileResource
    {
        return new FundProfileResource(FundProfile::current());
    }

    /**
     * List Initiatives
     */
    public function initiatives(Request $request): AnonymousResourceCollection
    {
        $initiatives = FundInitiative::query()
            ->where('is_active', true)
            ->when($request->status, fn ($q, $v) => $q->where('status', $v))
            ->latest()
            ->paginate($request->input('per_page', 15));

        return FundInitiativeResource::collection($initiatives);
    }

    /**
     * List My Support Requests
     *
     * @queryParam status string Filter by status (pending/under_review/approved/rejected/disbursed).
     * @queryParam per_page integer Items per page.
     */
    public function mySupportRequests(Request $request): AnonymousResourceCollection
    {
        $requests = SupportRequest::query()
            ->with('media')
            ->where('user_id', $request->user()->id)
            ->when($request->status, fn ($q, $v) => $q->where('status', $v))
            ->latest()
            ->paginate($request->input('per_page', 15));

        return SupportRequestResource::collection($requests);
    }

    /**
     * Show My Support Request
     */
    public function showSupportRequest(Request $request, int $id): SupportRequestResource
    {
        $supportRequest = SupportRequest::query()
            ->with('media')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return new SupportRequestResource($supportRequest);
    }

    /**
     * Submit Support Request
     *
     * @bodyParam title string required
     * @bodyParam description string required
     * @bodyParam amount_requested number
     * @bodyParam attachments file[] Optional attachments (pdf/jpg/png/doc).
     */
    public function storeSupportRequest(StoreSupportRequest $request): JsonResponse
    {
        $supportRequest = SupportRequest::create([
            'user_id' => $request->user()->id,
            'title' => $request->string('title')->toString(),
            'description' => $request->string('description')->toString(),
            'amount_requested' => $request->input('amount_requested'),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $supportRequest->addMedia($file)->toMediaCollection('attachments');
            }
        }

        User::query()
            ->where('role', UserRole::Admin)
            ->where('status', UserStatus::Active)
            ->each(fn (User $admin) => $admin->notify(new AdminSupportRequestSubmitted($supportRequest)));

        return response()->json([
            'message' => __('messages.support_request_submitted'),
            'support_request' => new SupportRequestResource($supportRequest->fresh('media')),
        ], 201);
    }
}
