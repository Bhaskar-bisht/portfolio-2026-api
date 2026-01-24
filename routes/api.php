<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\SocialLinkController;

// ============================================
// PORTFOLIO OWNER (Main User) ROUTES
// ============================================
Route::prefix('profile')->group(function () {
        Route::get('/', [PortfolioController::class, 'getProfile']); // Complete profile with all details
        Route::get('/skills', [PortfolioController::class, 'getSkills']); // All skills with proficiency
        Route::get('/education', [PortfolioController::class, 'getEducation']); // Education history
        Route::get('/experience', [PortfolioController::class, 'getExperience']); // Work experience
        Route::get('/certifications', [PortfolioController::class, 'getCertifications']); // Certifications
        Route::get('/achievements', [PortfolioController::class, 'getAchievements']); // Awards & achievements
        Route::get('/social-links', [PortfolioController::class, 'getSocialLinks']); // Social media links
        Route::get('/stats', [PortfolioController::class, 'getStats']); // Portfolio statistics
});

// ============================================
// PROJECTS ROUTES
// ============================================
Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index']); // All projects (with filters)
        Route::get('/featured', [ProjectController::class, 'getFeatured']); // Featured projects only
        Route::get('/{slug}', [ProjectController::class, 'show']); // Single project by slug
        Route::get('/{slug}/related', [ProjectController::class, 'getRelated']); // Related projects
});

// ============================================
// BLOGS/ARTICLES ROUTES
// ============================================
Route::prefix('blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index']); // All published blogs
        Route::get('/featured', [BlogController::class, 'getFeatured']); // Featured blogs
        Route::get('/latest', [BlogController::class, 'getLatest']); // Latest 5 blogs
        Route::get('/{slug}', [BlogController::class, 'show']); // Single blog by slug
        Route::get('/{slug}/related', [BlogController::class, 'getRelated']); // Related blogs
        Route::post('/{slug}/like', [BlogController::class, 'like']); // Like a blog
});

// ============================================
// CATEGORIES ROUTES
// ============================================
Route::prefix('categories')->group(function () {
        Route::get('/', [ProjectController::class, 'getCategories']); // All categories
        Route::get('/{slug}', [ProjectController::class, 'getProjectsByCategory']); // Projects by category
});

// ============================================
// TECHNOLOGIES/SKILLS ROUTES
// ============================================
Route::prefix('technologies')->group(function () {
        Route::get('/', [PortfolioController::class, 'getTechnologies']); // All technologies
        Route::get('/featured', [PortfolioController::class, 'getFeaturedTechnologies']); // Featured tech stack
});

// ============================================
// SERVICES ROUTES
// ============================================
Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index']); // All active services
        Route::get('/featured', [ServiceController::class, 'getFeatured']); // Featured services
        Route::get('/{slug}', [ServiceController::class, 'show']); // Single service
});

// ============================================
// TESTIMONIALS ROUTES
// ============================================
Route::prefix('testimonials')->group(function () {
        Route::get('/', [PortfolioController::class, 'getTestimonials']); // All approved testimonials
        Route::get('/featured', [PortfolioController::class, 'getFeaturedTestimonials']); // Featured only
});

// ============================================
// CONTACT ROUTES
// ============================================
Route::prefix('contact')->group(function () {
        Route::post('/', [ContactController::class, 'submit']); // Submit contact form
});

// ============================================
// TAGS ROUTES (for blogs)
// ============================================
Route::prefix('tags')->group(function () {
        Route::get('/', [BlogController::class, 'getTags']); // All tags
        Route::get('/{slug}/blogs', [BlogController::class, 'getBlogsByTag']); // Blogs by tag
});

// ============================================
// SEARCH & FILTERS
// ============================================
Route::get('/search', [PortfolioController::class, 'search']); // Global search

// ============================================
// PUBLIC STATS (for homepage)
// ============================================
Route::get('/stats/overview', [PortfolioController::class, 'getOverviewStats']); // Total projects, blogs, etc.

Route::get('/social-links', [SocialLinkController::class, 'index']);
