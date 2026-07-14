<?php

namespace App\Models\Astpp;

class FreeswichServer extends BaseAstppModel
{
    protected $table = 'freeswich_servers';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'status' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
    ];

}
