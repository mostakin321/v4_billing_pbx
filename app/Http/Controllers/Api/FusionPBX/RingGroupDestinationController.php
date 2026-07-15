<?php

namespace App\Http\Controllers\Api\FusionPBX;

class RingGroupDestinationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\RingGroupDestination::class;

    protected string $primaryKey = 'ring_group_destination_uuid';
}
