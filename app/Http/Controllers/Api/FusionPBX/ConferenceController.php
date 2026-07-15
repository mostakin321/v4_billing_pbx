<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Conference::class;

    protected string $primaryKey = 'conference_uuid';
}
