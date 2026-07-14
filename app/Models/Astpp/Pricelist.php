<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pricelist extends BaseAstppModel
{
    protected $table = 'pricelists';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'routing_type' => 'integer',
        'initially_increment' => 'integer',
        'inc' => 'integer',
        'status' => 'integer',
        'reseller_id' => 'integer',
        'pricelist_id_admin' => 'integer',
        'call_count' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function accountsByPricelistId(): HasMany
    {
        return $this->hasMany(Account::class, 'pricelist_id', 'id');
    }

    public function cdrsByPricelistId(): HasMany
    {
        return $this->hasMany(Cdr::class, 'pricelist_id', 'id');
    }

    public function cdrsStagingByPricelistId(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'pricelist_id', 'id');
    }

    public function ipMapByPricelistId(): HasMany
    {
        return $this->hasMany(IpMap::class, 'pricelist_id', 'id');
    }

    public function resellerCdrsByPricelistId(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'pricelist_id', 'id');
    }

    public function routesByPricelistId(): HasMany
    {
        return $this->hasMany(Route::class, 'pricelist_id', 'id');
    }

    public function routingByPricelistId(): HasMany
    {
        return $this->hasMany(Routing::class, 'pricelist_id', 'id');
    }

}
