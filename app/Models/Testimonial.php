<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'testimonial_type',
        'name',
        'position',
        'company',
        'content',
        'rating',
        'linkedin_url',
        'is_featured',
        'is_approved',
        'testimoniable_type',
        'testimoniable_id',
        'display_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(name: 'avatar')
            ->singleFile()
            ->useDisk('public');

        $this->addMediaCollection('company_logo')
            ->singleFile()
            ->useDisk('public');
    }

    // Relations
    public function testimoniable()
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
