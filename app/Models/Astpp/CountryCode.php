<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CountryCode extends BaseAstppModel
{
    protected $table = 'countrycode';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'currency_id' => 'integer',
        'countrycode' => 'integer',
        'vat' => 'decimal:6',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function accessnumberByCountryId(): HasMany
    {
        return $this->hasMany(Accessnumber::class, 'country_id', 'id');
    }

    public function accountUnverifiedByCountryId(): HasMany
    {
        return $this->hasMany(AccountUnverified::class, 'country_id', 'id');
    }

    public function accountsByCountryId(): HasMany
    {
        return $this->hasMany(Account::class, 'country_id', 'id');
    }

    public function accountsCdrSummaryByCountryId(): HasMany
    {
        return $this->hasMany(AccountsCdrSummary::class, 'country_id', 'id');
    }

    public function cdrsByCountryId(): HasMany
    {
        return $this->hasMany(Cdr::class, 'country_id', 'id');
    }

    public function cdrsDayBySummaryByCountryId(): HasMany
    {
        return $this->hasMany(CdrsDayBySummary::class, 'country_id', 'id');
    }

    public function cdrsStagingByCountryId(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'country_id', 'id');
    }

    public function didsByCountryId(): HasMany
    {
        return $this->hasMany(Did::class, 'country_id', 'id');
    }

    public function localizationByCountryId(): HasMany
    {
        return $this->hasMany(Localization::class, 'country_id', 'id');
    }

    public function packagePatternsByCountryId(): HasMany
    {
        return $this->hasMany(PackagePattern::class, 'country_id', 'id');
    }

    public function productsByCountryId(): HasMany
    {
        return $this->hasMany(Product::class, 'country_id', 'id');
    }

    public function providerCdrSummaryByCountryId(): HasMany
    {
        return $this->hasMany(ProviderCdrSummary::class, 'country_id', 'id');
    }

    public function ratedeckByCountryId(): HasMany
    {
        return $this->hasMany(Ratedeck::class, 'country_id', 'id');
    }

    public function resellerCdrsByCountryId(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'country_id', 'id');
    }

    public function resellerProductsByCountryId(): HasMany
    {
        return $this->hasMany(ResellerProduct::class, 'country_id', 'id');
    }

    public function routesByCountryId(): HasMany
    {
        return $this->hasMany(Route::class, 'country_id', 'id');
    }

}
