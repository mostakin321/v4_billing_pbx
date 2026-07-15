<?php

namespace App\Http\Controllers\Api\FusionPBX;

class GroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Group::class;

    protected string $primaryKey = 'group_uuid';
}
