<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountUnverified extends BaseAstppModel
{
    protected $table = 'account_unverified';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'reseller_id' => 'integer',
        'country_id' => 'integer',
        'currency_id' => 'integer',
        'timezone_id' => 'integer',
        'otp' => 'integer',
        'retries' => 'integer',
        'creation_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class, 'timezone_id', 'id');
    }

}
