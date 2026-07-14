<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Model;

abstract class BaseAstppModel extends Model
{
    protected $connection = 'astpp';
    public $timestamps = false;
    protected $guarded = [];
}
