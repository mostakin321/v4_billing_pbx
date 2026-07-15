<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceSessionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceSession::class;

    protected string $primaryKey = 'conference_session_uuid';
}
