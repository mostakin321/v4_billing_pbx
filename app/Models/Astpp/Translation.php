<?php

namespace App\Models\Astpp;

class Translation extends BaseAstppModel
{
    protected $table = 'translations';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [

    ];

}
