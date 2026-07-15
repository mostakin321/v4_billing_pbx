<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceProfileParamController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceProfileParam::class;

    protected string $primaryKey = 'conference_profile_param_uuid';
}
