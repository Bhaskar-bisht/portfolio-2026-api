<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Get all published blogs
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Blog::with(['tags', 'user'])
                ->published()
                ->orderBy('published_at', 'desc');

            // Search
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('excerpt', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%");
                });
            }

            // Filter by tag
            if ($request->has('tag')) {
                $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('slug', $request->tag);
                });
            }

            $perPage = $request->get('per_page', 10);
            $blogs = $query->paginate($perPage);

            $blogs->getCollection()->transform(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'excerpt' => $blog->excerpt,
                    'reading_time' => $blog->reading_time,
                    'featured_image' => $blog->getFirstMediaUrl('featured_image'),
                    'published_at' => $blog->published_at->format('M d, Y'),
                    'views_count' => $blog->views_count,
                    'likes_count' => $blog->likes_count,
                    'is_featured' => $blog->is_featured,
                    'author' => [
                        'name' => $blog->user->name,
                        'avatar' => $blog->user->getFirstMediaUrl('avatar'),
                    ],
                    'tags' => $blog->tags->map(function ($tag) {
                        return [
                            'name' => $tag->name,
                            'slug' => $tag->slug,
                            'color_code' => $tag->color_code,
                        ];
                    }),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $blogs->items(),
                'meta' => [
                    'current_page' => $blogs->currentPage(),
                    'last_page' => $blogs->lastPage(),
                    'per_page' => $blogs->perPage(),
                    'total' => $blogs->total(),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching blogs',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get featured blogs
     */
    public function getFeatured(): JsonResponse
    {
        try {
            $blogs = Blog::with(['tags', 'user'])
                ->published()
                ->featured()
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();

            $formattedBlogs = $blogs->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'excerpt' => $blog->excerpt,
                    'reading_time' => $blog->reading_time,
                    'featured_image' => $blog->getFirstMediaUrl('featured_image'),
                    'published_at' => $blog->published_at->format('M d, Y'),
                    'tags' => $blog->tags->pluck('name'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedBlogs,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured blogs',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get latest 5 blogs
     */
    public function getLatest(): JsonResponse
    {
        try {
            $blogs = Blog::with(['tags'])
                ->published()
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get(['id', 'title', 'slug', 'published_at', 'reading_time']);

            return response()->json([
                'success' => true,
                'data' => $blogs,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching latest blogs',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get single blog by slug
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $blog = Blog::with(['tags', 'user'])
                ->where('slug', $slug)
                ->published()
                ->firstOrFail();

            // Increment views
            $blog->increment('views_count');

            $data = [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'excerpt' => $blog->excerpt,
                'body' => $blog->body,
                'reading_time' => $blog->reading_time,
                'featured_image' => $blog->getFirstMediaUrl('featured_image'),
                'published_at' => $blog->published_at->format('M d, Y'),
                'views_count' => $blog->views_count,
                'likes_count' => $blog->likes_count,
                'shares_count' => $blog->shares_count,
                'meta_title' => $blog->meta_title,
                'meta_description' => $blog->meta_description,
                'author' => [
                    'name' => $blog->user->name,
                    'bio' => $blog->user->bio,
                    'avatar' => $blog->user->getFirstMediaUrl('avatar'),
                ],
                'tags' => $blog->tags,
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching blog',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get related blogs
     */
    public function getRelated(string $slug): JsonResponse
    {
        try {
            $blog = Blog::where('slug', $slug)->firstOrFail();

            $tagIds = $blog->tags->pluck('id');

            $relatedBlogs = Blog::with(['tags'])
                ->published()
                ->where('id', '!=', $blog->id)
                ->where(function ($query) use ($tagIds) {
                    $query->whereHas('tags', function ($q) use ($tagIds) {
                        $q->whereIn('tags.id', $tagIds);
                    });
                })
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();

            $formattedBlogs = $relatedBlogs->map(function ($blog) {
                return [
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'excerpt' => $blog->excerpt,
                    'featured_image' => $blog->getFirstMediaUrl('featured_image'),
                    'published_at' => $blog->published_at->format('M d, Y'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedBlogs,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching related blogs',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Like a blog
     */
    public function like(string $slug): JsonResponse
    {
        try {
            $blog = Blog::where('slug', $slug)->firstOrFail();
            $blog->increment('likes_count');

            return response()->json([
                'success' => true,
                'message' => 'Blog liked successfully',
                'likes_count' => $blog->likes_count,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error liking blog',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all tags
     */
    public function getTags(): JsonResponse
    {
        try {
            $tags = Tag::withCount('blogs')
                ->having('blogs_count', '>', 0)
                ->orderBy('blogs_count', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tags,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching tags',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get blogs by tag
     */
    public function getBlogsByTag(string $slug): JsonResponse
    {
        try {
            $tag = Tag::where('slug', $slug)->firstOrFail();

            $blogs = Blog::with(['tags', 'user'])
                ->published()
                ->whereHas('tags', function ($query) use ($tag) {
                    $query->where('tags.id', $tag->id);
                })
                ->orderBy('published_at', 'desc')
                ->paginate(10);

            $blogs->getCollection()->transform(function ($blog) {
                return [
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'excerpt' => $blog->excerpt,
                    'featured_image' => $blog->getFirstMediaUrl('featured_image'),
                    'published_at' => $blog->published_at->format('M d, Y'),
                ];
            });

            return response()->json([
                'success' => true,
                'tag' => $tag->name,
                'data' => $blogs->items(),
                'meta' => [
                    'current_page' => $blogs->currentPage(),
                    'last_page' => $blogs->lastPage(),
                    'total' => $blogs->total(),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching blogs by tag',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
