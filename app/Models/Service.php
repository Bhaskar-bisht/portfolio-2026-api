<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'pricing_type',
        'starting_price',
        'features',
        'delivery_time',
        'is_active',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'features' => 'array',
        'starting_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(name: 'thumbnail')
            ->singleFile()
            ->useDisk('public');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
