<?php

namespace App\Models\Cgrates;

class TpThreshold extends CgratesModel
{
    protected $table = 'tp_thresholds';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'filter_ids', 'activation_interval',
        'max_hits', 'min_hits', 'min_sleep', 'blocker', 'weight',
        'action_ids', 'async', 'ee_ids', 'created_at',
    ];

    protected $casts = [
        'blocker' => 'boolean',
        'weight' => 'decimal:2',
        'async' => 'boolean',
        'created_at' => 'datetime',
    ];
}
