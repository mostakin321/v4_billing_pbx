<?php

namespace App\Models\Cgrates;

class TpResource extends CgratesModel
{
    protected $table = 'tp_resources';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'filter_ids',
        'activation_interval', 'usage_ttl', 'limit', 'allocation_message',
        'blocker', 'stored', 'weight', 'threshold_ids', 'created_at',
    ];

    protected $casts = [
        'blocker' => 'boolean',
        'stored' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
