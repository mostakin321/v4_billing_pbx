<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceSetting::class;

    protected string $primaryKey = 'device_setting_uuid';
}
