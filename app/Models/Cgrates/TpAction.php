<?php

namespace App\Models\Cgrates;

class TpAction extends CgratesModel
{
    protected $table = 'tp_actions';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'tpid',
        'tag',
        'action',
        'extra_parameters',
        'filters',
        'balance_tag',
        'balance_type',
        'categories',
        'destination_tags',
        'rating_subject',
        'shared_groups',
        'expiry_time',
        'timing_tags',
        'units',
        'balance_weight',
        'balance_blocker',
        'balance_disabled',
        'weight',
        'created_at',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
