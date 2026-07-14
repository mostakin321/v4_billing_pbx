<?php

namespace App\Models\FusionPBX;


class Device extends BaseFusionPbxModel
{
    protected $table = 'v_devices';

    protected $primaryKey = 'device_uuid';

    protected $casts = [
        'device_enabled_date' => 'datetime',
        'device_provisioned_date' => 'datetime',
    ];

}
