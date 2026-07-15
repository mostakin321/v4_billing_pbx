<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CallCenterTierController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\CallCenterTier::class;

    protected string $primaryKey = 'call_center_tier_uuid';
}
