<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ExtensionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Extension::class;

    protected string $primaryKey = 'extension_uuid';
}
