<?php

namespace App\Models\Astpp;

class ReportsProcessList extends BaseAstppModel
{
    protected $table = 'reports_process_list';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'last_execution_date' => 'datetime',
    ];

}
