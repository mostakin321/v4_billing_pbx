<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends BaseAstppModel
{
    protected $table = 'currency';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'currencyrate' => 'decimal:6',
        'last_updated' => 'datetime',
        'is_supported' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function accountUnverifiedByCurrencyId(): HasMany
    {
        return $this->hasMany(AccountUnverified::class, 'currency_id', 'id');
    }

    public function accountsByCurrencyId(): HasMany
    {
        return $this->hasMany(Account::class, 'currency_id', 'id');
    }

    public function countrycodeByCurrencyId(): HasMany
    {
        return $this->hasMany(CountryCode::class, 'currency_id', 'id');
    }

    public function refillCouponByCurrencyId(): HasMany
    {
        return $this->hasMany(RefillCoupon::class, 'currency_id', 'id');
    }

}
