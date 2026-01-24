<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Get all active services
     */
    public function index(): JsonResponse
    {
        try {
            $services = Service::active()
                ->orderBy('display_order')
                ->get();

            $formattedServices = $services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'description' => $service->description,
                    'icon' => $service->icon,
                    'thumbnail' => $service->getFirstMediaUrl('thumbnail'),
                    'pricing_type' => $service->pricing_type,
                    'starting_price' => $service->starting_price,
                    'delivery_time' => $service->delivery_time,
                    // 'features' => $service->features,
                    'features' => json_decode($service->features, true) ?? [],
                    'is_featured' => $service->is_featured,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedServices,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching services',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get featured services
     */
    public function getFeatured(): JsonResponse
    {
        try {
            $services = Service::active()
                ->featured()
                ->orderBy('display_order')
                ->take(3)
                ->get();

            $formattedServices = $services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'description' => $service->description,
                    'icon' => $service->icon,
                    'starting_price' => $service->starting_price,
                    'pricing_type' => $service->pricing_type,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedServices,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured services',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get single service by slug
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $service = Service::where('slug', $slug)
                ->active()
                ->firstOrFail();

            $data = [
                'id' => $service->id,
                'title' => $service->title,
                'slug' => $service->slug,
                'description' => $service->description,
                'icon' => $service->icon,
                'thumbnail' => $service->getFirstMediaUrl('thumbnail'),
                'pricing_type' => $service->pricing_type,
                'starting_price' => $service->starting_price,
                'features' => $service->features,
                'delivery_time' => $service->delivery_time,
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching service',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
