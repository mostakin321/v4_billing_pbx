<?php

namespace App\Http\Controllers\Api\FusionPBX;

class PermissionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Permission::class;

    protected string $primaryKey = 'permission_uuid';
}
