<?php

namespace App\Http\Controllers\Api\FusionPBX;

class EmergencyLogController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\EmergencyLog::class;

    protected string $primaryKey = 'emergency_log_uuid';
}
