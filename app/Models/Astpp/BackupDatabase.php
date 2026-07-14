<?php

namespace App\Models\Astpp;

class BackupDatabase extends BaseAstppModel
{
    protected $table = 'backup_database';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'date' => 'datetime',
    ];

}
