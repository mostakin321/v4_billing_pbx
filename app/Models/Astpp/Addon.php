<?php

namespace App\Models\Astpp;

class Addon extends BaseAstppModel
{
    protected $table = 'addons';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'installed_date' => 'datetime',
        'last_updated_date' => 'datetime',
    ];

}
