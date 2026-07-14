<?php

namespace App\Models\Cgrates;

class TpIp extends CgratesModel
{
    protected $table = 'tp_ips';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'filter_ids',
        'activation_interval', 'ttl', 'type', 'address_pool',
        'allocation', 'stored', 'weight', 'created_at',
    ];

    protected $casts = [
        'stored' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
