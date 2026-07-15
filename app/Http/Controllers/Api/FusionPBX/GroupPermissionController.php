<?php

namespace App\Http\Controllers\Api\FusionPBX;

class GroupPermissionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\GroupPermission::class;

    protected string $primaryKey = 'group_permission_uuid';
}
