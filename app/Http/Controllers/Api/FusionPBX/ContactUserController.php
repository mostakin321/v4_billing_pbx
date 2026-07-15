<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactUserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactUser::class;

    protected string $primaryKey = 'contact_user_uuid';
}
