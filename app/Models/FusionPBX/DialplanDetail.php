<?php

namespace App\Models\FusionPBX;

class DialplanDetail extends BaseFusionPbxModel
{
    protected $table = 'v_dialplan_details';
    protected $primaryKey = 'dialplan_detail_uuid';

    // Don't cast enabled to boolean — FusionPBX stores 'true'/'false' strings
    protected $casts = [
        'dialplan_detail_group' => 'float',
        'dialplan_detail_order' => 'float',
    ];
}
