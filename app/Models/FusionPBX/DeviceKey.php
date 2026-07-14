<?php

namespace App\Models\FusionPBX;


class DeviceKey extends BaseFusionPbxModel
{
    protected $table = 'v_device_keys';

    protected $primaryKey = 'device_key_uuid';

    protected $casts = [
        'device_key_id' => 'float',
        'device_key_line' => 'float',
    ];

}
