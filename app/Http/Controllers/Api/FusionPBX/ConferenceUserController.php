<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceUserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceUser::class;

    protected string $primaryKey = 'conference_user_uuid';
}
