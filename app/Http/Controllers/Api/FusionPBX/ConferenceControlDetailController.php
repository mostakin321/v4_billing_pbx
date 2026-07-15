<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceControlDetailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceControlDetail::class;

    protected string $primaryKey = 'conference_control_detail_uuid';
}
