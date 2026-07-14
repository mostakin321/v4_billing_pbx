<?php

namespace App\Models\Cgrates;

class TpSharedGroup extends CgratesModel
{
    protected $table = 'tp_shared_groups';
    public $timestamps = false;

    protected $fillable = [
        'id', 'tpid', 'tag', 'account', 'strategy', 'rating_subject', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
