<?php

namespace App\DTO;

class ChargingProfileData
{
    public function __construct(
        public string $tenant,
        public string $id,
        public string $runId,
        public array|string|null $filterIds = null,
        public array|string|null $attributeIds = null,
        public float $weight = 0,
    ) {}
}
