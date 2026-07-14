<?php

namespace App\Models\Astpp;

class MenuModule extends BaseAstppModel
{
    protected $table = 'menu_modules';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'priority' => 'decimal:6',
    ];

}
