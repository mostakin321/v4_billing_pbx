<?php

namespace App\Http\Controllers\Api\FusionPBX;

class NumberTranslationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\NumberTranslation::class;

    protected string $primaryKey = 'number_translation_uuid';
}
