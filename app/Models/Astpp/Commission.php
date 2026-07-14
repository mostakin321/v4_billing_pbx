<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends BaseAstppModel
{
    protected $table = 'commission';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'product_id' => 'integer',
        'order_id' => 'integer',
        'accountid' => 'integer',
        'reseller_id' => 'integer',
        'payment_id' => 'integer',
        'amount' => 'decimal:6',
        'commission' => 'decimal:6',
        'commission_rate' => 'decimal:6',
        'creation_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function paymentTransaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class, 'payment_id', 'id');
    }

}
