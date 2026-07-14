<?php

namespace App\Models\FusionPBX;


class CallCenterTier extends BaseFusionPbxModel
{
    protected $table = 'v_call_center_tiers';

    protected $primaryKey = 'call_center_tier_uuid';

    protected $casts = [
        'tier_level' => 'float',
        'tier_position' => 'float',
    ];

}
