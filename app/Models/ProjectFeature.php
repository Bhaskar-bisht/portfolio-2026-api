<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'icon',
        'display_order',
    ];

    // Relations
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}