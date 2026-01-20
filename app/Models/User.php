<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'tagline',
        'current_position',
        'years_of_experience',
        'location',
        'timezone',
        'availability_status',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'behance_url',
        'dribbble_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('resume')
            ->singleFile()
            ->acceptsMimeTypes(['application/pdf'])
            ->useDisk('public');
    }

    // Relations
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function socialLinks()
    {
        return $this->hasMany(SocialLink::class);
    }

    public function testimonials()
    {
        return $this->morphMany(Testimonial::class, 'testimoniable');
    }

    public function seoMetadata()
    {
        return $this->morphOne(SeoMetadata::class, 'seoable');
    }
}
