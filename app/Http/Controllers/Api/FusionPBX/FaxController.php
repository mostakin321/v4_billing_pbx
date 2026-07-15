<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FaxController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Fax::class;

    protected string $primaryKey = 'fax_uuid';
}
