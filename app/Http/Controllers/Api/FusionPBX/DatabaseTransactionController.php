<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DatabaseTransactionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DatabaseTransaction::class;

    protected string $primaryKey = 'database_transaction_uuid';
}
