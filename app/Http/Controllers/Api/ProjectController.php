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
            $query = Project::with(['categories', 'technologies', 'testimonials', 'media'])
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
                // Get thumbnail
                $thumbnail = $project->getFirstMedia('thumbnail_image');
                $thumbnailUrl = $thumbnail ? $thumbnail->getUrl() : null;

                // Get banner
                $banner = $project->getFirstMedia('banner_image');
                $bannerUrl = $banner ? $banner->getUrl() : null;

                // Get gallery images
                $gallery = $project->getMedia('gallery_image')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'url' => $media->getUrl(),
                        'thumb' => $media->hasGeneratedConversion('thumb')
                            ? $media->getUrl('thumb')
                            : $media->getUrl(),
                        'name' => $media->name,
                        'file_name' => $media->file_name,
                        'size' => $media->size,
                    ];
                });

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
                    'thumbnail' => $thumbnailUrl,
                    'banner' => $bannerUrl,
                    'gallery' => $gallery,
                    'categories' => $project->categories->map(function ($category) {
                        return [
                            'id' => $category->id,
                            'name' => $category->name,
                            'slug' => $category->slug,
                            'color_code' => $category->color_code,
                        ];
                    }),
                    'technologies' => $project->technologies->map(function ($tech) {
                        $logo = $tech->getFirstMedia('logo');
                        return [
                            'id' => $tech->id,
                            'name' => $tech->name,
                            'slug' => $tech->slug,
                            'color_code' => $tech->color_code,
                            'logo' => $logo ? $logo->getUrl() : null,
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
            $projects = Project::with(['categories', 'technologies', 'media'])
                ->published()
                ->featured()
                ->orderBy('priority', 'desc')
                ->take(6)
                ->get();

            $formattedProjects = $projects->map(function ($project) {
                $thumbnail = $project->getFirstMedia('thumbnail_image');

                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'slug' => $project->slug,
                    'short_description' => $project->short_description,
                    'project_type' => $project->project_type,
                    'thumbnail' => $thumbnail ? $thumbnail->getUrl() : null,
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
                },
                'media'
            ])
                ->where('slug', $slug)
                ->published()
                ->firstOrFail();

            // Increment views
            $project->increment('views_count');

            // Get thumbnail
            $thumbnail = $project->getFirstMedia('thumbnail_image');
            $thumbnailUrl = $thumbnail ? $thumbnail->getUrl() : null;

            // Get banner
            $banner = $project->getFirstMedia('banner_image');
            $bannerUrl = $banner ? $banner->getUrl() : null;

            // Get gallery with thumbnails
            $gallery = $project->getMedia('gallery_image')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                    'thumb' => $media->hasGeneratedConversion('thumb')
                        ? $media->getUrl('thumb')
                        : $media->getUrl(),
                    'name' => $media->name,
                    'file_name' => $media->file_name,
                ];
            });

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
                'started_at' => $project->started_at?->format('d-M-Y'),
                'completed_at' => $project->completed_at?->format('d-M-Y'),
                'budget_range' => $project->budget_range,
                'team_size' => $project->team_size,
                'views_count' => $project->views_count,
                'likes_count' => $project->likes_count,
                'thumbnail' => $thumbnailUrl,
                'banner' => $bannerUrl,
                'gallery' => $gallery,
                'categories' => $project->categories,
                'technologies' => $project->technologies->map(function ($tech) {
                    $logo = $tech->getFirstMedia('logo');
                    return [
                        'name' => $tech->name,
                        'slug' => $tech->slug,
                        'logo' => $logo ? $logo->getUrl() : null,
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
                    $avatar = $testimonial->getFirstMedia('avatar');
                    return [
                        'name' => $testimonial->name,
                        'position' => $testimonial->position,
                        'company' => $testimonial->company,
                        'content' => $testimonial->content,
                        'rating' => $testimonial->rating,
                        'avatar' => $avatar ? $avatar->getUrl() : null,
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

            $relatedProjects = Project::with(['categories', 'technologies', 'media'])
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
                $thumbnail = $project->getFirstMedia('thumbnail_image');

                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'slug' => $project->slug,
                    'short_description' => $project->short_description,
                    'thumbnail' => $thumbnail ? $thumbnail->getUrl() : null,
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
            $categories = Category::with('media')
                ->active()
                ->withCount('projects')
                ->orderBy('display_order')
                ->get();

            $formattedCategories = $categories->map(function ($category) {
                $icon = $category->getFirstMedia('icon');

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                    'icon' => $icon ? $icon->getUrl() : null,
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

            $projects = Project::with(['categories', 'technologies', 'media'])
                ->published()
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(12);

            $projects->getCollection()->transform(function ($project) {
                $thumbnail = $project->getFirstMedia('thumbnail_image');

                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'slug' => $project->slug,
                    'short_description' => $project->short_description,
                    'thumbnail' => $thumbnail ? $thumbnail->getUrl() : null,
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
