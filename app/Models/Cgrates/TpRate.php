<?php
namespace App\Models\Cgrates;
class TpRate extends CgratesModel
{
    protected $table    = 'tp_rates';
    protected $fillable = ['tpid','tag','connect_fee','rate','rate_unit','rate_increment','group_interval_start'];
}
