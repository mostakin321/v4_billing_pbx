<?php
namespace App\Models\Astpp;
class Q850Code extends BaseAstppModel
{
    protected $table = 'q850code';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $casts = ['code' => 'integer'];
}
