<?php

namespace App\Http\Controllers\Api\FusionPBX;

class RingGroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\RingGroup::class;

    protected string $primaryKey = 'ring_group_uuid';
}
