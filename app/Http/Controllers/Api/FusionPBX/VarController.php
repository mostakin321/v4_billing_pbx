<?php

namespace App\Http\Controllers\Api\FusionPBX;

class VarController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FpbxVar::class;

    protected string $primaryKey = 'var_uuid';
}
