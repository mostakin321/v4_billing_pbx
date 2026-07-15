<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DialplanController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Dialplan::class;

    protected string $primaryKey = 'dialplan_uuid';
}
