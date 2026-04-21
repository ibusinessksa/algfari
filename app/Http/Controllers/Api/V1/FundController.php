<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\FundTransactionResource;
use App\Models\FamilyFundTransaction;
use App\Services\FundService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Family Fund
 *
 * APIs for viewing family fund transactions and summary.
 */
class FundController extends Controller
{
    public function __construct(private FundService $fundService) {}

    /**
     * List Transactions
     *
     * Get a paginated list of approved fund transactions.
     *
     * @queryParam type string Filter by transaction type (donation/expense). Example: donation
     * @queryParam per_page integer Items per page. Example: 15
     *
     * @response 200 scenario="success" {
     *   "data": [
     *     {
     *       "id": 1,
     *       "amount": "500.00",
     *       "transaction_type": "donation",
     *       "description": {"ar": "تبرع شهري لصندوق العائلة", "en": "Monthly donation"},
     *       "status": "approved",
     *       "receipt": "http://algfari.test/storage/media/20/receipt.pdf",
     *       "receipt_thumb": null,
     *       "contributor": {"id": 2, "full_name": "سعد القحطاني"},
     *       "approved_at": "2026-04-10T12:00:00.000000Z",
     *       "created_at": "2026-04-09T10:00:00.000000Z"
     *     },
     *     {
     *       "id": 2,
     *       "amount": "200.00",
     *       "transaction_type": "expense",
     *       "description": {"ar": "مصاريف إصلاح مجلس العائلة", "en": "Repair expenses"},
     *       "status": "approved",
     *       "receipt": null,
     *       "receipt_thumb": null,
     *       "contributor": null,
     *       "approved_at": "2026-04-11T14:00:00.000000Z",
     *       "created_at": "2026-04-11T09:00:00.000000Z"
     *     }
     *   ],
     *   "links": {"first": "http://algfari.test/api/v1/fund?page=1", "last": "http://algfari.test/api/v1/fund?page=1", "prev": null, "next": null},
     *   "meta": {"current_page": 1, "last_page": 1, "per_page": 15, "total": 2}
     * }
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
     *
     * Get the family fund financial summary (total donations, expenses, and balance).
     *
     * @response 200 {"total_donations": 15000.00, "total_expenses": 5000.00, "balance": 10000.00, "transactions_count": 42}
     */
    public function summary(): JsonResponse
    {
        return response()->json($this->fundService->getSummary());
    }
}
