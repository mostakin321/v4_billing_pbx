<?php

namespace App\Models\Cgrates;

class Version extends CgratesModel
{
    protected $table = 'versions';
    public $timestamps = false;

    protected $fillable = [
        'id', 'item', 'version',
    ];
}
