<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FollowMeDestinationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FollowMeDestination::class;

    protected string $primaryKey = 'follow_me_destination_uuid';
}
