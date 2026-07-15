<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DomainController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Domain::class;

    protected string $primaryKey = 'domain_uuid';
}
