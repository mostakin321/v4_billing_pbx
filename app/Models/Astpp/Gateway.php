<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gateway extends BaseAstppModel
{
    protected $table = 'gateways';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'sip_profile_id' => 'integer',
        'created_date' => 'datetime',
        'accountid' => 'integer',
        'status' => 'integer',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function sipProfile(): BelongsTo
    {
        return $this->belongsTo(SipProfile::class, 'sip_profile_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function trunksByGatewayId(): HasMany
    {
        return $this->hasMany(Trunk::class, 'gateway_id', 'id');
    }

    public function trunksByFailoverGatewayId(): HasMany
    {
        return $this->hasMany(Trunk::class, 'failover_gateway_id', 'id');
    }

    public function trunksByFailoverGatewayId1(): HasMany
    {
        return $this->hasMany(Trunk::class, 'failover_gateway_id1', 'id');
    }

}
