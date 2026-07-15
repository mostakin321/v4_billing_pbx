<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceKeyController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceKey::class;

    protected string $primaryKey = 'device_key_uuid';
}
