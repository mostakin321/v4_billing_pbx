<?php

namespace App\Models\Astpp;

class CronSetting extends BaseAstppModel
{
    protected $table = 'cron_settings';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'exec_interval' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
        'last_execution_date' => 'datetime',
        'next_execution_date' => 'datetime',
        'status' => 'integer',
    ];

}
