<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceProfileController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceProfile::class;

    protected string $primaryKey = 'conference_profile_uuid';
}
