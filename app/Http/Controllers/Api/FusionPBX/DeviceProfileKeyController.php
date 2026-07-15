<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceProfileKeyController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceProfileKey::class;

    protected string $primaryKey = 'device_profile_key_uuid';
}
