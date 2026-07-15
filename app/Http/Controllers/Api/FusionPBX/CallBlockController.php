<?php

namespace App\Http\Controllers\Api\FusionPBX;

class CallBlockController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\CallBlock::class;

    protected string $primaryKey = 'call_block_uuid';
}
