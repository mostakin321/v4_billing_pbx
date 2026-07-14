<?php
namespace App\Models\Cgrates;
class TpRatingPlan extends CgratesModel
{
    protected $table    = 'tp_rating_plans';
    protected $fillable = ['tpid','tag','destrates_tag','timing_tag','weight'];
}
