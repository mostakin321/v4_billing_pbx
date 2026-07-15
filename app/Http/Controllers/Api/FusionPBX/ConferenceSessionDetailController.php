<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceSessionDetailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceSessionDetail::class;

    protected string $primaryKey = 'conference_session_detail_uuid';
}
