<?php

namespace App\Models\Cgrates;

class TpRanking extends CgratesModel
{
    protected $table = 'tp_rankings';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'schedule', 'stat_ids',
        'metric_ids', 'sorting', 'sorting_parameters', 'stored',
        'threshold_ids', 'created_at',
    ];

    protected $casts = [
        'stored' => 'boolean',
        'created_at' => 'datetime',
    ];
}
