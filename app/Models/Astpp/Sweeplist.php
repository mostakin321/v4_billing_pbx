<?php

namespace App\Models\Astpp;

class Sweeplist extends BaseAstppModel
{
    protected $table = 'sweeplist';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [

    ];

}
