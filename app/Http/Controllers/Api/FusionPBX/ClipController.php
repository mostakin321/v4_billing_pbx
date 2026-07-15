<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ClipController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Clip::class;

    protected string $primaryKey = 'clip_uuid';
}
