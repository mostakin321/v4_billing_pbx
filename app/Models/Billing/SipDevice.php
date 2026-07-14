<?php
namespace App\Models\Billing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class SipDevice extends Model
{
    protected $table = 'sip_devices';
    public $timestamps = false;
    protected $fillable = [
        'username','sip_profile_id','reseller_id','accountid',
        'status','call_waiting','dir_params','dir_vars',
        'creation_date','last_modified_date'
    ];
    public function account(): BelongsTo { return $this->belongsTo(Account::class,'accountid'); }
    public function reseller(): BelongsTo { return $this->belongsTo(Account::class,'reseller_id'); }
}
