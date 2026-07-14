<?php

namespace App\Models\Astpp;

class License extends BaseAstppModel
{
    protected $table = 'license';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'created_date' => 'datetime',
        'last_updated_date' => 'datetime',
    ];

}
