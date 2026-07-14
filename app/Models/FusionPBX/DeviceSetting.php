<?php

namespace App\Models\FusionPBX;


class DeviceSetting extends BaseFusionPbxModel
{
    protected $table = 'v_device_settings';

    protected $primaryKey = 'device_setting_uuid';
}
