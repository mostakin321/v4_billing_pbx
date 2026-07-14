<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cdr extends BaseAstppModel
{
    protected $table = 'cdrs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'type' => 'integer',
        'ct' => 'integer',
        'billseconds' => 'integer',
        'trunk_id' => 'integer',
        'callstart' => 'datetime',
        'debit' => 'decimal:6',
        'cost' => 'decimal:6',
        'provider_id' => 'integer',
        'pricelist_id' => 'integer',
        'package_id' => 'integer',
        'invoiceid' => 'integer',
        'rate_cost' => 'decimal:6',
        'reseller_id' => 'integer',
        'reseller_cost' => 'decimal:6',
        'provider_cost' => 'decimal:6',
        'provider_call_cost' => 'decimal:6',
        'billmsec' => 'integer',
        'answermsec' => 'integer',
        'waitmsec' => 'integer',
        'progress_mediamsec' => 'integer',
        'flow_billmsec' => 'integer',
        'is_recording' => 'integer',
        'call_request' => 'integer',
        'country_id' => 'integer',
        'end_stamp' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'provider_id', 'id');
    }

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id', 'id');
    }

    public function packageProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'package_id', 'id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoiceid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'calltype', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

}
