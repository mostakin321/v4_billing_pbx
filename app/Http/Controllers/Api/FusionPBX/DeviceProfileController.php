<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceProfileController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceProfile::class;

    protected string $primaryKey = 'device_profile_uuid';
}
