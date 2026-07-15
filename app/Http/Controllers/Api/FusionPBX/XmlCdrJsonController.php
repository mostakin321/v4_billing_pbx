<?php

namespace App\Http\Controllers\Api\FusionPBX;

class XmlCdrJsonController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\XmlCdrJson::class;

    protected string $primaryKey = 'xml_cdr_json_uuid';
}
