<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CallCenterAgentController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\CallCenterAgent::class;

    protected string $primaryKey = 'call_center_agent_uuid';
}
