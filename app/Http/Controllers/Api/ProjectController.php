<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Get all projects with filters
     */
    public function index(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'msg' => 'this is the date'
            ]);
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching projects',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get featured projects
     */
    public function getFeatured(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured projects',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get single project by slug
     */
    public function show(string $slug): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching project',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get related projects
     */
    public function getRelated(string $slug): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching related projects',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all categories
     */
    public function getCategories(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching categories',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get projects by category
     */
    public function getProjectsByCategory(string $slug): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching projects by category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
