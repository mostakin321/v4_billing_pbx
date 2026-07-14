<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends BaseAstppModel
{
    protected $table = 'invoice_details';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'reseller_id' => 'integer',
        'invoiceid' => 'integer',
        'order_item_id' => 'integer',
        'payment_id' => 'integer',
        'product_category' => 'integer',
        'is_tax' => 'integer',
        'exchange_rate' => 'decimal:6',
        'debit' => 'decimal:6',
        'credit' => 'decimal:6',
        'created_date' => 'datetime',
        'generate_type' => 'integer',
        'quantity' => 'integer',
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

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoiceid', 'id');
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'id');
    }

    public function paymentTransaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class, 'payment_id', 'id');
    }

}
