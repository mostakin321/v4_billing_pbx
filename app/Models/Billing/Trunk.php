<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trunk extends BaseBillingModel
{
    protected $table = 'trunks';

    protected $fillable = [
        'name', 'tech', 'gateway_id', 'failover_gateway_id',
        'failover_gateway_id1', 'provider_id', 'status',
        'dialed_modify', 'resellers_id', 'precedence',
        'maxchannels', 'cps', 'codec', 'leg_timeout',
        'cid_translation', 'localization_id', 'sip_cid_type',
    ];

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'gateway_id');
    }

    public function failoverGateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'failover_gateway_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'provider_id');
    }
}
