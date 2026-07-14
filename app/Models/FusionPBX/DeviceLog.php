<?php

namespace App\Models\FusionPBX;


class DeviceLog extends BaseFusionPbxModel
{
    protected $table = 'v_device_logs';

    protected $primaryKey = 'device_log_uuid';
}
