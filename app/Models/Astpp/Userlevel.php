<?php

namespace App\Models\Astpp;

class Userlevel extends BaseAstppModel
{
    protected $table = 'userlevels';
    protected $primaryKey = 'userlevelid';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [

    ];

}
