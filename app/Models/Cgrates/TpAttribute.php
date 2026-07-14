<?php

namespace App\Models\Cgrates;

class TpAttribute extends CgratesModel
{
    protected $table = 'tp_attributes';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk',
        'tpid',
        'tenant',
        'id',
        'contexts',
        'filter_ids',
        'activation_interval',
        'attribute_filter_ids',
        'path',
        'type',
        'value',
        'blocker',
        'weight',
        'created_at',
    ];

    protected $casts = [
        'blocker' => 'boolean',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
