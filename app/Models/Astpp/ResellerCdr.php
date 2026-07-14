<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResellerCdr extends BaseAstppModel
{
    protected $table = 'reseller_cdrs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'billseconds' => 'integer',
        'callstart' => 'datetime',
        'debit' => 'decimal:6',
        'cost' => 'decimal:6',
        'pricelist_id' => 'integer',
        'package_id' => 'integer',
        'reseller_id' => 'integer',
        'rate_cost' => 'decimal:6',
        'reseller_cost' => 'decimal:6',
        'call_request' => 'integer',
        'country_id' => 'integer',
        'end_stamp' => 'datetime',
        'trunk_id' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id', 'id');
    }

    public function packageProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'package_id', 'id');
    }

    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'calltype', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id', 'id');
    }

}
