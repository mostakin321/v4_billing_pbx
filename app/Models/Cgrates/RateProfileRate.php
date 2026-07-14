<?php
namespace App\Models\Cgrates;
class RateProfileRate extends CgratesModel
{
    protected $table    = 'rate_profile_rates';
    public $timestamps  = false;
    protected $fillable = ['rate_profile_id','destination_prefix','destination_name','rate_per_minute','setup_fee','currency'];
}
