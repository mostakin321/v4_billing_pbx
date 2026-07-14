<?php

namespace App\Models\Astpp;

class Timezone extends BaseAstppModel
{
    protected $table = 'timezone';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'gmtoffset' => 'integer',
    ];

}
