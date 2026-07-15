<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FifoMemberController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FifoMember::class;

    protected string $primaryKey = 'fifo_member_uuid';
}
