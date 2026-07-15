<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceControlController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceControl::class;

    protected string $primaryKey = 'conference_control_uuid';
}
