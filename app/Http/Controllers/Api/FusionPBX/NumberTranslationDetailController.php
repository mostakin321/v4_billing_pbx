<?php

namespace App\Http\Controllers\Api\FusionPBX;

class NumberTranslationDetailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\NumberTranslationDetail::class;

    protected string $primaryKey = 'number_translation_detail_uuid';
}
