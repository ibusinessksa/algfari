<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * @group Contact
 *
 * Public contact information for the family app.
 */
class ContactController extends Controller
{
    /**
     * Contact Info
     *
     * Returns public contact channels (phone, email, social URLs).
     */
    public function index(): JsonResponse
    {
        $data = Cache::remember('contact_info', now()->addMinutes(15), function () {
            $s = AppSetting::current();
            return [
                'contact_phone' => $s->contact_phone,
                'contact_whatsapp' => $s->contact_whatsapp,
                'contact_email' => $s->contact_email,
                'social' => [
                    'twitter' => $s->twitter_url,
                    'instagram' => $s->instagram_url,
                    'snapchat' => $s->snapchat_url,
                    'tiktok' => $s->tiktok_url,
                    'youtube' => $s->youtube_url,
                ],
            ];
        });

        return response()->json($data);
    }
}
