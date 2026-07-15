<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ModuleController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Module::class;

    protected string $primaryKey = 'module_uuid';
}
