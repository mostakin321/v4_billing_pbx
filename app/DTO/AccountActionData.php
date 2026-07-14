<?php

namespace App\DTO;

class AccountActionData
{
    public function __construct(
        public string $tenant,
        public string $account,
        public ?string $actionPlanTag = null,
        public ?string $actionTriggersTag = null,
        public bool $allowNegative = false,
        public bool $disabled = false,
    ) {}
}
