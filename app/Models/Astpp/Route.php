<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends BaseAstppModel
{
    protected $table = 'routes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'connectcost' => 'decimal:6',
        'includedseconds' => 'integer',
        'cost' => 'decimal:6',
        'pricelist_id' => 'integer',
        'inc' => 'integer',
        'country_id' => 'integer',
        'call_count' => 'integer',
        'accountid' => 'integer',
        'reseller_id' => 'integer',
        'precedence' => 'integer',
        'status' => 'integer',
        'init_inc' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'call_type', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id', 'id');
    }

    public function routingByRoutesId(): HasMany
    {
        return $this->hasMany(Routing::class, 'routes_id', 'id');
    }

}
