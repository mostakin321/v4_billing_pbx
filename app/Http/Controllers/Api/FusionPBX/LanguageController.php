<?php

namespace App\Http\Controllers\Api\FusionPBX;

class LanguageController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Language::class;

    protected string $primaryKey = 'language_uuid';
}
