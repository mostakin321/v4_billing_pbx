<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FaxLogController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FaxLog::class;

    protected string $primaryKey = 'fax_log_uuid';
}
