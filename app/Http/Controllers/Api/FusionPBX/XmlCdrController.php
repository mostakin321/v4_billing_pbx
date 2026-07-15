<?php

namespace App\Http\Controllers\Api\FusionPBX;

class XmlCdrController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\XmlCdr::class;

    protected string $primaryKey = 'xml_cdr_uuid';
}
