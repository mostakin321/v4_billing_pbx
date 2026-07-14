<?php

namespace App\Models\Astpp;

class CiSession extends BaseAstppModel
{
    protected $table = 'ci_sessions';
    protected $primaryKey = 'session_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'last_activity' => 'integer',
    ];

}
