<?php

namespace App\Models\Cgrates;

class TpActionTrigger extends CgratesModel
{
    protected $table = 'tp_action_triggers';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tpid',
        'tag',
        'unique_id',
        'threshold_type',
        'threshold_value',
        'recurrent',
        'min_sleep',
        'expiry_time',
        'activation_time',
        'balance_tag',
        'balance_type',
        'balance_categories',
        'balance_destination_tags',
        'balance_rating_subject',
        'balance_shared_groups',
        'balance_expiry_time',
        'balance_timing_tags',
        'balance_weight',
        'balance_blocker',
        'balance_disabled',
        'actions_tag',
        'weight',
        'created_at',
    ];

    protected $casts = [
        'threshold_value' => 'decimal:4',
        'recurrent' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
