<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountsCdrSummary extends BaseAstppModel
{
    protected $table = 'accounts_cdr_summary';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [
        'date_hour' => 'datetime',
        'country_id' => 'integer',
        'account_entity_id' => 'integer',
        'account_id' => 'integer',
        'reseller_id' => 'integer',
        'total_calls' => 'integer',
        'answered_calls' => 'integer',
        'minutes' => 'integer',
        'debit' => 'decimal:6',
        'cost' => 'decimal:6',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
