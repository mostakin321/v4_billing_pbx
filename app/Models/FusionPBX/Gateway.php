<?php

namespace App\Models\FusionPBX;


class Gateway extends BaseFusionPbxModel
{
    protected $table = 'v_gateways';

    protected $primaryKey = 'gateway_uuid';

    protected $casts = [
        'channels' => 'float',
        'expire_seconds' => 'float',
        'retry_seconds' => 'float',
    ];

}
