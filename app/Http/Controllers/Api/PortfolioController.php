<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Certification;
use App\Models\Achievement;
use App\Models\SocialLink;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Models\Project;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Get complete profile with all details
     */
    public function getProfile(): JsonResponse
    {
        try {
            $user = User::with([
                'skills.technology',
                'educations',
                'experiences.technologies',
                'certifications',
                'achievements',
                'socialLinks'
            ])->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile not found',
                ], 404);
            }
            Log::info('this is the info0', ['res' => $user]);
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'bio' => $user->bio,
                    'tagline' => $user->tagline,
                    'current_position' => $user->current_position,
                    'years_of_experience' => $user->years_of_experience,
                    'location' => $user->location,
                    'timezone' => $user->timezone,
                    'availability_status' => $user->availability_status,
                    'github_url' => $user->github_url,
                    'linkedin_url' => $user->linkedin_url,
                    'twitter_url' => $user->twitter_url,
                    'behance_url' => $user->behance_url,
                    'dribbble_url' => $user->dribbble_url,
                    'avatar' => $user->getFirstMediaUrl('avatar'),
                    'resume' => $user->getFirstMediaUrl('resume'),
                    'skills' => $user->skills,
                    'education' => $user->educations,
                    'experience' => $user->experiences,
                    'certifications' => $user->certifications,
                    'achievements' => $user->achievements,
                    'social_links' => $user->socialLinks,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching profile',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get skills with proficiency
     */
    public function getSkills(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching skills',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get education history
     */
    public function getEducation(): JsonResponse
    {
        try {
            // Get education records with media and order by display_order
            $education = Education::with(['media' => function ($query) {
                $query->whereIn('collection_name', ['institution_logo', 'certificate']);
            }])
                ->orderBy('display_order', 'asc')
                ->get();

            // Transform the data to include media URLs
            $educationData = $education->map(function ($item) {
                $logo = $item->getFirstMedia('institution_logo');
                $certificate = $item->getFirstMedia('certificate');

                return [
                    'id' => $item->id,
                    'user_id' => $item->user_id,
                    'institution_name' => $item->institution_name,
                    'degree' => $item->degree,
                    'field_of_study' => $item->field_of_study,
                    'grade' => $item->grade,
                    'start_date' => $item->start_date ? $item->start_date->format('Y-m-d') : null,
                    'end_date' => $item->end_date ? $item->end_date->format('Y-m-d') : null,
                    'is_current' => $item->is_current,
                    'description' => $item->description,
                    'achievements' => $item->achievements,
                    'location' => $item->location,
                    'certificate_url' => $item->certificate_url,
                    'display_order' => $item->display_order,
                    'institution_logo_url' => $logo ? $logo->getUrl() : null,
                    'certificate_file_url' => $certificate ? $certificate->getUrl() : null,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $item->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Education data retrieved successfully',
                'data' => $educationData,
                'count' => $educationData->count(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching education',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get work experience
     */
    public function getExperience(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching experience',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get certifications
     */
    public function getCertifications(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching certifications',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get achievements
     */
    public function getAchievements(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching achievements',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get social links
     */
    public function getSocialLinks(): JsonResponse
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

    /**
     * Get portfolio statistics
     */
    public function getStats(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching stats',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get all technologies
     */
    public function getTechnologies(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching technologies',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get featured technologies
     */
    public function getFeaturedTechnologies(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured technologies',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get testimonials
     */
    public function getTestimonials(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching testimonials',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get featured testimonials
     */
    public function getFeaturedTestimonials(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching featured testimonials',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Global search
     */
    public function search(Request $request): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error performing search',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get overview statistics
     */
    public function getOverviewStats(): JsonResponse
    {
        try {
            // Your code here
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching overview stats',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
