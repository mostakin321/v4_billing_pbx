<?php

namespace App\Models\Cgrates;

class TpDispatcherProfile extends CgratesModel
{
    protected $table = 'tp_dispatcher_profiles';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'subsystems', 'filter_ids',
        'activation_interval', 'strategy', 'strategy_parameters', 'conn_id',
        'conn_filter_ids', 'conn_weight', 'conn_blocker', 'conn_parameters',
        'weight', 'created_at',
    ];

    protected $casts = [
        'conn_weight' => 'decimal:2',
        'conn_blocker' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
