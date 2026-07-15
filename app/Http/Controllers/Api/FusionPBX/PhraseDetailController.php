<?php

namespace App\Http\Controllers\Api\FusionPBX;

class PhraseDetailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\PhraseDetail::class;

    protected string $primaryKey = 'phrase_detail_uuid';
}
