<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trunk extends BaseAstppModel
{
    protected $table = 'trunks';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'gateway_id' => 'integer',
        'failover_gateway_id' => 'integer',
        'failover_gateway_id1' => 'integer',
        'provider_id' => 'integer',
        'status' => 'integer',
        'precedence' => 'integer',
        'maxchannels' => 'integer',
        'cps' => 'integer',
        'leg_timeout' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
        'localization_id' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'gateway_id', 'id');
    }

    public function failoverGateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'failover_gateway_id', 'id');
    }

    public function failoverGateway1(): BelongsTo
    {
        return $this->belongsTo(Gateway::class, 'failover_gateway_id1', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'provider_id', 'id');
    }

    public function localization(): BelongsTo
    {
        return $this->belongsTo(Localization::class, 'localization_id', 'id');
    }

    public function cdrsByTrunkId(): HasMany
    {
        return $this->hasMany(Cdr::class, 'trunk_id', 'id');
    }

    public function cdrsStagingByTrunkId(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'trunk_id', 'id');
    }

    public function outboundRoutesByTrunkId(): HasMany
    {
        return $this->hasMany(OutboundRoute::class, 'trunk_id', 'id');
    }

    public function providerCdrSummaryByTrunkId(): HasMany
    {
        return $this->hasMany(ProviderCdrSummary::class, 'trunk_id', 'id');
    }

    public function resellerCdrsByTrunkId(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'trunk_id', 'id');
    }

    public function routesByTrunkId(): HasMany
    {
        return $this->hasMany(Route::class, 'trunk_id', 'id');
    }

    public function routingByTrunkId(): HasMany
    {
        return $this->hasMany(Routing::class, 'trunk_id', 'id');
    }

}
