<?php
namespace App\Models\Cgrates;
class TpDestinationRate extends CgratesModel
{
    protected $table    = 'tp_destination_rates';
    protected $fillable = ['tpid','tag','destinations_tag','rates_tag','rounding_method','rounding_decimals','max_cost','max_cost_strategy'];
}
