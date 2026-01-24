<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;

class SocialLinkController extends Controller
{
        /**
         * Get all active social links for the portfolio owner
         */
        public function index(): JsonResponse
        {
                try {
                        // Get first user's social links (portfolio owner)
                        $socialLinks = SocialLink::where('is_active', true)
                                ->orderBy('display_order')
                                ->get(['id', 'platform', 'url', 'username', 'icon']);

                        return response()->json([
                                'success' => true,
                                'data' => $socialLinks,
                        ], 200);
                } catch (\Exception $e) {
                        return response()->json([
                                'success' => false,
                                'message' => 'Error fetching social links',
                                'error' => $e->getMessage(),
                        ], 500);
                }
        }
}
