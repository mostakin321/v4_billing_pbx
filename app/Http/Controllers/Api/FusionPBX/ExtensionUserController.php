<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ExtensionUserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ExtensionUser::class;

    protected string $primaryKey = 'extension_user_uuid';
}
