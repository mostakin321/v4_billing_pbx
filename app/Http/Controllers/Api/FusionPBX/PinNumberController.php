<?php

namespace App\Http\Controllers\Api\FusionPBX;

class PinNumberController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\PinNumber::class;

    protected string $primaryKey = 'pin_number_uuid';
}
