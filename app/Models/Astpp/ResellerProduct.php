<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResellerProduct extends BaseAstppModel
{
    protected $table = 'reseller_products';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'product_id' => 'integer',
        'account_id' => 'integer',
        'reseller_id' => 'integer',
        'country_id' => 'integer',
        'status' => 'integer',
        'buy_cost' => 'decimal:6',
        'price' => 'decimal:6',
        'free_minutes' => 'integer',
        'commission' => 'decimal:6',
        'setup_fee' => 'decimal:6',
        'billing_days' => 'integer',
        'billing_type' => 'integer',
        'is_owner' => 'integer',
        'is_optin' => 'integer',
        'optin_date' => 'datetime',
        'modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

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
