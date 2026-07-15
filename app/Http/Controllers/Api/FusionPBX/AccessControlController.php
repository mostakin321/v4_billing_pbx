<?php

namespace App\Http\Controllers\Api\FusionPBX;

class AccessControlController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\AccessControl::class;

    protected string $primaryKey = 'access_control_uuid';
}
