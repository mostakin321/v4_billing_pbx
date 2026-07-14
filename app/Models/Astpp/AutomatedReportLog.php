<?php

namespace App\Models\Astpp;

class AutomatedReportLog extends BaseAstppModel
{
    protected $table = 'automated_report_log';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'creation_date' => 'datetime',
        'purge_date' => 'date',
    ];

}
