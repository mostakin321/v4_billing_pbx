<?php

namespace App\Http\Controllers\Api\FusionPBX;

class MenuLanguageController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\MenuLanguage::class;

    protected string $primaryKey = 'menu_language_uuid';
}
