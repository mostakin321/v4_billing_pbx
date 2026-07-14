<?php

namespace App\Models\Astpp;

class Language extends BaseAstppModel
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [

    ];

}
