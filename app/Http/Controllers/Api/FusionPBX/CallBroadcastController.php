<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CallBroadcastController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\CallBroadcast::class;

    protected string $primaryKey = 'call_broadcast_uuid';
}
