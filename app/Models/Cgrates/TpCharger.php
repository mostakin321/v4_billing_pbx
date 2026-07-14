<?php

namespace App\Models\Cgrates;

class TpCharger extends CgratesModel
{
    protected $table = 'tp_chargers';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'filter_ids',
        'activation_interval', 'run_id', 'attribute_ids', 'weight', 'created_at',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
