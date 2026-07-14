<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Models\FusionPBX\Gateway;

class GatewayController extends BaseCrudController
{
    protected string $modelClass = Gateway::class;

    protected string $primaryKey = 'gateway_uuid';
}
