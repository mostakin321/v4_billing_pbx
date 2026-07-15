<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceLineController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceLine::class;

    protected string $primaryKey = 'device_line_uuid';
}
