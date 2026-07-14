<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderCdrSummary extends BaseAstppModel
{
    protected $table = 'provider_cdr_summary';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $casts = [
        'country_id' => 'integer',
        'provider_id' => 'integer',
        'trunk_id' => 'integer',
        'total_calls' => 'integer',
        'answered_calls' => 'integer',
        'cost' => 'decimal:6',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'provider_id', 'id');
    }

    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id', 'id');
    }

}
