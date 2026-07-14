<?php
namespace App\Models\Cgrates;
class TpDestination extends CgratesModel
{
    protected $table    = 'tp_destinations';
    protected $fillable = ['tpid','tag','prefix'];
}
