<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceLogController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceLog::class;

    protected string $primaryKey = 'device_log_uuid';
}
