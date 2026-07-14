<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends BaseBillingModel
{
    protected $table = 'order_items';
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'product_category', 'product_id',
        'quantity', 'price', 'setup_fee', 'billing_type',
        'billing_days', 'free_minutes', 'accountid',
        'reseller_id', 'billing_date', 'next_billing_date',
        'is_terminated', 'termination_date', 'termination_note',
    ];

    protected $casts = [
        'price'             => 'decimal:5',
        'setup_fee'         => 'decimal:5',
        'billing_date'      => 'datetime',
        'next_billing_date' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
