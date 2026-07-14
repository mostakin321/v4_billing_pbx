<?php

namespace App\Services\Cgrates\Rating;

use App\DTO\RatingProfileData;
use App\Models\Cgrates\TpRatingProfile;

class RatingProfileProvisioner
{
    public function upsert(RatingProfileData $data, string $tpid = 'default', string $loadid = 'laravel'): TpRatingProfile
    {
        return TpRatingProfile::updateOrCreate(
            [
                'tpid' => $tpid,
                'loadid' => $loadid,
                'tenant' => $data->tenant,
                'category' => $data->category,
                'subject' => $data->subject,
                'activation_time' => $data->activationTime,
            ],
            [
                'rating_plan_tag' => $data->ratingPlanTag,
                'fallback_subjects' => is_array($data->fallbackSubjects) ? implode(',', $data->fallbackSubjects) : $data->fallbackSubjects,
            ]
        );
    }
}
