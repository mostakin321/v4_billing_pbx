<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefillCoupon extends BaseAstppModel
{
    protected $table = 'refill_coupon';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'amount' => 'decimal:6',
        'status' => 'integer',
        'firstused' => 'datetime',
        'account_id' => 'integer',
        'reseller_id' => 'integer',
        'currency_id' => 'integer',
        'creation_date' => 'datetime',
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

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

}
