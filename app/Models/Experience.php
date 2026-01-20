<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Experience extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'company_name',
        'position',
        'employment_type',
        'location',
        'is_remote',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'achievements',
        'company_url',
        'display_order',
    ];

    protected $casts = [
        'is_remote' => 'boolean',
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'achievements' => 'array',
    ];

    // Media Collections
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('company_logo')
            ->singleFile()
            ->useDisk('public');
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'experience_technology')
            ->withTimestamps();
    }

    // Scopes
    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }
}