<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DestinationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Destination::class;

    protected string $primaryKey = 'destination_uuid';
}
