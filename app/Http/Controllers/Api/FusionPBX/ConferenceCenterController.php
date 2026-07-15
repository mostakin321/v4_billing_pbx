<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceCenterController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceCenter::class;

    protected string $primaryKey = 'conference_center_uuid';
}
