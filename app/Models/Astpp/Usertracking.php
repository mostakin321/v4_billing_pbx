<?php

namespace App\Models\Astpp;

class Usertracking extends BaseAstppModel
{
    protected $table = 'usertracking';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'timestamp' => 'datetime',
    ];

}
