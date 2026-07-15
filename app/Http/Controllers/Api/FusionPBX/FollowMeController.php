<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FollowMeController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FollowMe::class;

    protected string $primaryKey = 'follow_me_uuid';
}
