<?php

namespace App\Http\Controllers\Api\FusionPBX;

class EventGuardLogController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\EventGuardLog::class;

    protected string $primaryKey = 'event_guard_log_uuid';
}
