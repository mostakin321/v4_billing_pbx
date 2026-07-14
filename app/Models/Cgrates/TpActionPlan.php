<?php

namespace App\Models\Cgrates;

class TpActionPlan extends CgratesModel
{
    protected $table = 'tp_action_plans';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tpid',
        'tag',
        'actions_tag',
        'timing_tag',
        'weight',
        'created_at',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
