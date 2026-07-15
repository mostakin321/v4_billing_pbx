<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceProfileSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceProfileSetting::class;

    protected string $primaryKey = 'device_profile_setting_uuid';
}
