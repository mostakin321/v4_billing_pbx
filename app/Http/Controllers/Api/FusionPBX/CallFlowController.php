<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CallFlowController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\CallFlow::class;

    protected string $primaryKey = 'call_flow_uuid';
}
