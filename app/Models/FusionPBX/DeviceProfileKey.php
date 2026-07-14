<?php

namespace App\Models\FusionPBX;


class DeviceProfileKey extends BaseFusionPbxModel
{
    protected $table = 'v_device_profile_keys';

    protected $primaryKey = 'device_profile_key_uuid';

    protected $casts = [
        'profile_key_id' => 'float',
        'profile_key_line' => 'float',
    ];

}
