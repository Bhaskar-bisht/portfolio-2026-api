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
            $projects = Project::published()
                ->with(['categories', 'technologies', 'features'])
                ->orderBy('priority', 'asc')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($project) {
                    return [
                        'id' => $project->id,
                        'title' => $project->title,
                        'slug' => $project->slug,
                        'short_description' => $project->short_description,
                        'full_description' => $project->full_description,
                        'project_type' => $project->project_type,
                        'status' => $project->status,
                        'featured' => $project->featured,
                        'client_name' => $project->client_name,
                        'project_url' => $project->project_url,
                        'github_url' => $project->github_url,
                        'demo_url' => $project->demo_url,
                        'started_at' => $project->started_at,
                        'completed_at' => $project->completed_at,
                        'team_size' => $project->team_size,
                        'views_count' => $project->views_count,
                        'likes_count' => $project->likes_count,
                        'thumbnail' => $project->getFirstMediaUrl('thumbnail'),
                        'banner' => $project->getFirstMediaUrl('banner'),
                        'categories' => $project->categories->pluck('name'),
                        'technologies' => $project->technologies->map(fn($tech) => [
                            'id' => $tech->id,
                            'name' => $tech->name,
                            'usage_percentage' => $tech->pivot->usage_percentage,
                            'role' => $tech->pivot->role,
                        ]),
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Projects fetched successfully',
                'data' => $projects,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching projects',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
// ...existing code...

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
