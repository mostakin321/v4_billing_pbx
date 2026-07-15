<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactTimeController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactTime::class;

    protected string $primaryKey = 'contact_time_uuid';
}
