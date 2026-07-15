<?php

namespace App\Http\Controllers\Api\FusionPBX;

class XmlCdrFlowController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\XmlCdrFlow::class;

    protected string $primaryKey = 'xml_cdr_flow_uuid';
}
