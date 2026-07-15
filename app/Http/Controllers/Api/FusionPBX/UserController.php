<?php

namespace App\Http\Controllers\Api\FusionPBX;

class UserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\User::class;

    protected string $primaryKey = 'user_uuid';
}
