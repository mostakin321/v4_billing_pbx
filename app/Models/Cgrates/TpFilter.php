<?php

namespace App\Models\Cgrates;

class TpFilter extends CgratesModel
{
    protected $table = 'tp_filters';
    protected $primaryKey = 'pk';
    public $timestamps = false;

    protected $fillable = [
        'pk', 'tpid', 'tenant', 'id', 'type', 'element',
        'values', 'activation_interval', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
