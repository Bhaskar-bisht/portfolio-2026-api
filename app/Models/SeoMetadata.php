<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SeoMetadata extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'twitter_card',
        'twitter_title',
        'canonical_url',
        'robots',
        'schema_markup',
    ];

    protected $casts = [
        'schema_markup' => 'array',
    ];

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('og_image')
            ->singleFile()
            ->useDisk('public');
    }

    // Relations
    public function seoable()
    {
        return $this->morphTo();
    }
}