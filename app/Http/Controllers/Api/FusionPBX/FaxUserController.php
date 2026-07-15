<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FaxUserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FaxUser::class;

    protected string $primaryKey = 'fax_user_uuid';
}
