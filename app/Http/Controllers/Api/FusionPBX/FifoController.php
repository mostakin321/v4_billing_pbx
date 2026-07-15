<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FifoController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Fifo::class;

    protected string $primaryKey = 'fifo_uuid';
}
