<?php

namespace App\Http\Controllers\Api\FusionPBX;

class StreamController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Stream::class;

    protected string $primaryKey = 'stream_uuid';
}
