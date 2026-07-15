<?php

namespace App\Http\Controllers\Api\FusionPBX;

class RingGroupUserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\RingGroupUser::class;

    protected string $primaryKey = 'ring_group_user_uuid';
}
