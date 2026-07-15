<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DatabasController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Databas::class;

    protected string $primaryKey = 'database_uuid';
}
