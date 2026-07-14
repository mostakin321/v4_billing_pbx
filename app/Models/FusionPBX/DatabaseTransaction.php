<?php

namespace App\Models\FusionPBX;


class DatabaseTransaction extends BaseFusionPbxModel
{
    protected $table = 'v_database_transactions';

    protected $primaryKey = 'database_transaction_uuid';

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

}
