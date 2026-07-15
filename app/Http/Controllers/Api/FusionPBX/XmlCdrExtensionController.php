<?php

namespace App\Http\Controllers\Api\FusionPBX;

class XmlCdrExtensionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\XmlCdrExtension::class;

    protected string $primaryKey = 'xml_cdr_extension_uuid';
}
