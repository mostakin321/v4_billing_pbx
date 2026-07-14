<?php

namespace App\Models\FusionPBX;


class DeviceLine extends BaseFusionPbxModel
{
    protected $table = 'v_device_lines';

    protected $primaryKey = 'device_line_uuid';

    protected $casts = [
        'register_expires' => 'float',
        'sip_port' => 'float',
    ];

}
