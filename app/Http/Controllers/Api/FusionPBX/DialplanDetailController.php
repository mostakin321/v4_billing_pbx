<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DialplanDetailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DialplanDetail::class;

    protected string $primaryKey = 'dialplan_detail_uuid';
}
