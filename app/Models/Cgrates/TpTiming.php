<?php

namespace App\Models\Cgrates;

class TpTiming extends CgratesModel
{
    protected $table = 'tp_timings';
    public $timestamps = false;

    protected $fillable = [
        'id', 'tpid', 'tag', 'years', 'months', 'month_days',
        'week_days', 'time', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
