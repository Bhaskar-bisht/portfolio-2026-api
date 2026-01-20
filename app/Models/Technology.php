<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Technology extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'proficiency_level',
        'years_of_experience',
        'color_code',
        'background_color',
        'is_featured',
        'documentation_url',
        'official_url',
        'display_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->useDisk('public');
    }

    // Relations
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_technology')
            ->withPivot(['usage_percentage', 'role'])
            ->withTimestamps();
    }

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experience_technology')
            ->withTimestamps();
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}