<?php

namespace App\Http\Controllers\Api\FusionPBX;

class PhrasController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Phras::class;

    protected string $primaryKey = 'phrase_uuid';
}
