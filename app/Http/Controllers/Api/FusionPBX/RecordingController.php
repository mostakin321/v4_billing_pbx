<?php

namespace App\Http\Controllers\Api\FusionPBX;

class RecordingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Recording::class;

    protected string $primaryKey = 'recording_uuid';
}
