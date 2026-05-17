<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * @group Visitors
 *
 * Track and read the total app visitor count.
 */
class VisitorController extends Controller
{
    private const KEY = 'app';

    /**
     * Increment visitor counter
     *
     * Call once per app open / session start.
     *
     * @unauthenticated
     *
     * @response 200 {"count": 42}
     */
    public function increment(): JsonResponse
    {
        DB::table('visitor_counters')
            ->where('key', self::KEY)
            ->update([
                'count' => DB::raw('count + 1'),
                'updated_at' => now(),
            ]);

        $count = (int) DB::table('visitor_counters')
            ->where('key', self::KEY)
            ->value('count');

        return response()->json(['count' => $count]);
    }

    /**
     * Get visitor count
     *
     * @unauthenticated
     *
     * @response 200 {"count": 42}
     */
    public function show(): JsonResponse
    {
        $count = (int) (DB::table('visitor_counters')
            ->where('key', self::KEY)
            ->value('count') ?? 0);

        return response()->json(['count' => $count]);
    }
}
