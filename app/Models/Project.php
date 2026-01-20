<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'short_description',
        'full_description',
        'project_type',
        'status',
        'featured',
        'priority',
        'client_name',
        'client_feedback',
        'project_url',
        'github_url',
        'demo_url',
        'started_at',
        'completed_at',
        'budget_range',
        'team_size',
        'views_count',
        'likes_count',
        'is_published',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_published' => 'boolean',
        'started_at' => 'date',
        'completed_at' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($skill) {
            if (Auth::check() && empty($skill->user_id)) {
                $skill->user_id = Auth::id();
            }
        });
    }

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('banner')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('gallery')
            ->useDisk('public');
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'project_category');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'project_technology')
            ->withPivot(['usage_percentage', 'role'])
            ->withTimestamps();
    }

    public function features()
    {
        return $this->hasMany(ProjectFeature::class);
    }

    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'testimoniable');
    }

    public function analytics()
    {
        return $this->morphMany(Analytic::class, 'trackable');
    }

    public function seoMetadata()
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
