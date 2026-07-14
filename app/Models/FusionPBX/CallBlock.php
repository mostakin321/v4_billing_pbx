<?php

namespace App\Models\FusionPBX;


class CallBlock extends BaseFusionPbxModel
{
    protected $table = 'v_call_block';

    protected $primaryKey = 'call_block_uuid';

    protected $casts = [
        'call_block_count' => 'float',
        'call_block_country_code' => 'float',
    ];

}
