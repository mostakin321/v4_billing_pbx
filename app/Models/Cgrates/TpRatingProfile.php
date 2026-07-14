<?php

namespace App\Models\Cgrates;

class TpRatingProfile extends CgratesModel
{
    protected $table = 'tp_rating_profiles';
    public $timestamps = false;

    protected $fillable = [
        'id', 'tpid', 'loadid', 'tenant', 'category', 'subject',
        'activation_time', 'rating_plan_tag', 'fallback_subjects', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function scopeForTenant($query, string $tenant)
    {
        return $query->where('tenant', $tenant);
    }

    public function ratingPlanTag(): string
    {
        return (string) $this->rating_plan_tag;
    }
}
