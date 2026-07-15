<?php

namespace App\Http\Controllers\Api\FusionPBX;

class XmlCdrLogController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\XmlCdrLog::class;

    protected string $primaryKey = 'xml_cdr_log_uuid';
}
