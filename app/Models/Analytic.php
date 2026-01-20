<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'trackable_type',
        'trackable_id',
        'event_type',
        'ip_address',
        'user_agent',
        'referer_url',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
    ];

    // Relations
    public function trackable()
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeViews($query)
    {
        return $query->where('event_type', 'view');
    }

    public function scopeLikes($query)
    {
        return $query->where('event_type', 'like');
    }
}