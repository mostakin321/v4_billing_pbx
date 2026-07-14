<?php

namespace App\DTO;

class RatingProfileData
{
    public function __construct(
        public string $tenant,
        public string $category,
        public string $subject,
        public string $activationTime,
        public string $ratingPlanTag,
        public array|string|null $fallbackSubjects = null,
    ) {}
}
