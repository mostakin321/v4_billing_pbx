<?php
namespace App\Models\Billing;
use Illuminate\Database\Eloquent\Model;
class Gateway extends Model
{
    protected $table = 'gateways';
    public $timestamps = false;
    protected $fillable = [
        'sip_profile_id', 'name', 'gateway_data',
        'accountid', 'status', 'dialplan_variable',
        'created_date', 'last_modified_date'
    ];
    protected $casts = [
        'created_date'       => 'datetime',
        'last_modified_date' => 'datetime',
    ];
    public function getGatewayDataDecoded(): array
    {
        return json_decode($this->gateway_data ?? '{}', true) ?: [];
    }
}
