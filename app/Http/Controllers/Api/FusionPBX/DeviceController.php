<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Device::class;

    protected string $primaryKey = 'device_uuid';
}
