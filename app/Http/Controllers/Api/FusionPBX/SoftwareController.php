<?php

namespace App\Http\Controllers\Api\FusionPBX;

class SoftwareController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Software::class;

    protected string $primaryKey = 'software_uuid';
}
