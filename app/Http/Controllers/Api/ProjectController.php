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
            $query = Project::with(['categories', 'technologies', 'testimonials'])
                ->published()
                ->orderBy('priority', 'desc')
                ->orderBy('created_at', 'desc');

            // Filter by status
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Filter by type
            if ($request->has('type')) {
                $query->where('project_type', $request->type);
            }

            // Filter by category
            if ($request->has('category')) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }

            // Search
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('full_description', 'like', "%{$search}%");
                });
            }

            // Pagination
            $perPage = $request->get('per_page', 12);
            $projects = $query->paginate($perPage);

            // Format response with media
            $projects->getCollection()->transform(function ($project) {
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
                    'started_at' => $project->started_at?->format('Y-m-d'),
                    'completed_at' => $project->completed_at?->format('Y-m-d'),
                    'views_count' => $project->views_count,
                    'likes_count' => $project->likes_count,
                    'thumbnail' => $project->getFirstMediaUrl('thumbnail'),
                    'banner' => $project->getFirstMediaUrl('banner'),
                    'gallery' => $project->getMedia('gallery')->map(fn($media) => $media->getUrl()),
                    'categories' => $project->categories->map(function ($category) {
                        return [
                            'id' => $category->id,
                            'name' => $category->name,
                            'slug' => $category->slug,
                            'color_code' => $category->color_code,
                        ];
                    }),
                    'technologies' => $project->technologies->map(function ($tech) {
                        return [
                            'id' => $tech->id,
                            'name' => $tech->name,
                            'slug' => $tech->slug,
                            'color_code' => $tech->color_code,
                            'logo' => $tech->getFirstMediaUrl('logo'),
                        ];
                    }),
                    'created_at' => $project->created_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $projects->items(),
                'meta' => [
                    'current_page' => $projects->currentPage(),
                    'last_page' => $projects->lastPage(),
                    'per_page' => $projects->perPage(),
                    'total' => $projects->total(),
                ],
            ], 200);
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
            $projects = Project::with(['categories', 'technologies'])
                ->published()
                ->featured()
                ->orderBy('priority', 'desc')
                ->take(6)
                ->get();

            $formattedProjects = $projects->map(function ($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'slug' => $project->slug,
                    'short_description' => $project->short_description,
                    'project_type' => $project->project_type,
                    'thumbnail' => $project->getFirstMediaUrl('thumbnail'),
                    'categories' => $project->categories->pluck('name'),
                    'technologies' => $project->technologies->pluck('name'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedProjects,
            ], 200);
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
            $project = Project::with([
                'categories',
                'technologies',
                'features',
                'testimonials' => function ($query) {
                    $query->approved()->orderBy('display_order');
                }
            ])
                ->where('slug', $slug)
                ->published()
                ->firstOrFail();

            // Increment views
            $project->increment('views_count');

            $data = [
                'id' => $project->id,
                'title' => $project->title,
                'slug' => $project->slug,
                'short_description' => $project->short_description,
                'full_description' => $project->full_description,
                'project_type' => $project->project_type,
                'status' => $project->status,
                'client_name' => $project->client_name,
                'client_feedback' => $project->client_feedback,
                'project_url' => $project->project_url,
                'github_url' => $project->github_url,
                'demo_url' => $project->demo_url,
                'started_at' => $project->started_at?->format('Y-m-d'),
                'completed_at' => $project->completed_at?->format('Y-m-d'),
                'budget_range' => $project->budget_range,
                'team_size' => $project->team_size,
                'views_count' => $project->views_count,
                'likes_count' => $project->likes_count,
                'thumbnail' => $project->getFirstMediaUrl('thumbnail'),
                'banner' => $project->getFirstMediaUrl('banner'),
                'gallery' => $project->getMedia('gallery')->map(fn($media) => [
                    'url' => $media->getUrl(),
                    'thumb' => $media->getUrl('thumb'),
                ]),
                'categories' => $project->categories,
                'technologies' => $project->technologies->map(function ($tech) {
                    return [
                        'name' => $tech->name,
                        'slug' => $tech->slug,
                        'logo' => $tech->getFirstMediaUrl('logo'),
                        'usage_percentage' => $tech->pivot->usage_percentage,
                        'role' => $tech->pivot->role,
                    ];
                }),
                'features' => $project->features->map(function ($feature) {
                    return [
                        'title' => $feature->title,
                        'description' => $feature->description,
                        'icon' => $feature->icon,
                    ];
                }),
                'testimonials' => $project->testimonials->map(function ($testimonial) {
                    return [
                        'name' => $testimonial->name,
                        'position' => $testimonial->position,
                        'company' => $testimonial->company,
                        'content' => $testimonial->content,
                        'rating' => $testimonial->rating,
                        'avatar' => $testimonial->getFirstMediaUrl('avatar'),
                    ];
                }),
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
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
            $project = Project::where('slug', $slug)->firstOrFail();

            $categoryIds = $project->categories->pluck('id');

            $relatedProjects = Project::with(['categories', 'technologies'])
                ->published()
                ->where('id', '!=', $project->id)
                ->where(function ($query) use ($categoryIds) {
                    $query->whereHas('categories', function ($q) use ($categoryIds) {
                        $q->whereIn('categories.id', $categoryIds);
                    });
                })
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();

            $formattedProjects = $relatedProjects->map(function ($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'slug' => $project->slug,
                    'short_description' => $project->short_description,
                    'thumbnail' => $project->getFirstMediaUrl('thumbnail'),
                    'categories' => $project->categories->pluck('name'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedProjects,
            ], 200);
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
            $categories = Category::active()
                ->withCount('projects')
                ->orderBy('display_order')
                ->get();

            $formattedCategories = $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                    'icon' => $category->getFirstMediaUrl('icon'),
                    'color_code' => $category->color_code,
                    'projects_count' => $category->projects_count,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedCategories,
            ], 200);
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
            $category = Category::where('slug', $slug)->firstOrFail();

            $projects = Project::with(['categories', 'technologies'])
                ->published()
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $projects->getCollection()->transform(function ($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'slug' => $project->slug,
                    'short_description' => $project->short_description,
                    'thumbnail' => $project->getFirstMediaUrl('thumbnail'),
                    'technologies' => $project->technologies->pluck('name'),
                ];
            });

            return response()->json([
                'success' => true,
                'category' => [
                    'name' => $category->name,
                    'description' => $category->description,
                ],
                'data' => $projects->items(),
                'meta' => [
                    'current_page' => $projects->currentPage(),
                    'last_page' => $projects->lastPage(),
                    'total' => $projects->total(),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching projects by category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
