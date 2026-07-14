<?php

namespace App\Models\Cgrates;

class TpStat extends CgratesModel
{
    protected $table = 'tp_stats';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'filter_ids',
        'activation_interval', 'queue_length', 'ttl', 'min_items',
        'metric_ids', 'metric_filter_ids', 'stored', 'blocker', 'weight',
        'threshold_ids', 'created_at',
    ];

    protected $casts = [
        'stored' => 'boolean',
        'blocker' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
