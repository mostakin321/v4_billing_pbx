<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CallCenterQueueController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\CallCenterQueue::class;

    protected string $primaryKey = 'call_center_queue_uuid';
}
