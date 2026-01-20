<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'technology_id',
        'proficiency_percentage',
        'years_of_experience',
        'is_primary_skill',
        'last_used_at',
        'certification_url',
        'display_order',
    ];

    protected $casts = [
        'is_primary_skill' => 'boolean',
        'last_used_at' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($skill) {
            if (Auth::check() && empty($skill->user_id)) {
                $skill->user_id = Auth::id();
            }
        });
    }

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary_skill', true);
    }
}
