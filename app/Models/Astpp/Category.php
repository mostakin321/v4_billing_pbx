<?php

namespace App\Models\Astpp;

class Category extends BaseAstppModel
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'status' => 'integer',
        'creation_date' => 'datetime',
    ];

}
