<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CountryController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Country::class;

    protected string $primaryKey = 'country_uuid';
}
