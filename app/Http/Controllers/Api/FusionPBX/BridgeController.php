<?php

namespace App\Http\Controllers\Api\FusionPBX;

class BridgeController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Bridge::class;

    protected string $primaryKey = 'bridge_uuid';
}
