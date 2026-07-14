<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CdrsDayBySummary extends BaseAstppModel
{
    protected $table = 'cdrs_day_by_summary';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'account_id' => 'integer',
        'reseller_id' => 'integer',
        'type' => 'integer',
        'country_id' => 'integer',
        'billseconds' => 'integer',
        'mcd' => 'integer',
        'total_calls' => 'integer',
        'debit' => 'decimal:6',
        'cost' => 'decimal:6',
        'total_answered_call' => 'integer',
        'total_fail_call' => 'integer',
        'calldate' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

}
