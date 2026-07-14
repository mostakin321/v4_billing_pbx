<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends BaseAstppModel
{
    protected $table = 'payment_transaction';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'amount' => 'decimal:6',
        'actual_amount' => 'decimal:6',
        'payment_fee' => 'decimal:6',
        'reseller_id' => 'integer',
        'currency_rate' => 'decimal:6',
        'date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
