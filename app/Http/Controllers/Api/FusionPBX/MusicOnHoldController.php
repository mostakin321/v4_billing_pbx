<?php

namespace App\Http\Controllers\Api\FusionPBX;

class MusicOnHoldController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\MusicOnHold::class;

    protected string $primaryKey = 'music_on_hold_uuid';
}
