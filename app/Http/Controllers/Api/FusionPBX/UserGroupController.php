<?php

namespace App\Http\Controllers\Api\FusionPBX;

class UserGroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\UserGroup::class;

    protected string $primaryKey = 'user_group_uuid';
}
