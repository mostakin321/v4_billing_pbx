<?php

namespace App\Models\Cgrates;

class TpTrend extends CgratesModel
{
    protected $table = 'tp_trends';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'schedule', 'stat_id', 'metrics',
        'ttl', 'queue_length', 'min_items', 'correlation_type', 'tolerance',
        'stored', 'threshold_ids', 'created_at',
    ];

    protected $casts = [
        'tolerance' => 'decimal:2',
        'stored' => 'boolean',
        'created_at' => 'datetime',
    ];
}
