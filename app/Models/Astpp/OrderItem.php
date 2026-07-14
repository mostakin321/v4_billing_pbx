<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends BaseAstppModel
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'order_id' => 'integer',
        'product_category' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'decimal:6',
        'setup_fee' => 'decimal:6',
        'billing_type' => 'integer',
        'billing_days' => 'integer',
        'free_minutes' => 'integer',
        'accountid' => 'integer',
        'reseller_id' => 'integer',
        'billing_date' => 'datetime',
        'next_billing_date' => 'datetime',
        'is_terminated' => 'integer',
        'termination_date' => 'datetime',
        'exchange_rate' => 'decimal:6',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
