<?php
namespace App\Models\Cgrates;
class RateProfile extends CgratesModel
{
    protected $table    = 'rate_profiles';
    public $timestamps  = true;
    protected $fillable = ['name','description','is_active'];
    public function rates() {
        return $this->hasMany(RateProfileRate::class, 'rate_profile_id');
    }
    public function assignments() {
        return $this->hasMany(RateProfileAssignment::class, 'rate_profile_id');
    }
}
