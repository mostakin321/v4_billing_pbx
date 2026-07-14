<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends BaseAstppModel
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'parent_order_id' => 'integer',
        'order_date' => 'datetime',
        'order_generated_by' => 'integer',
        'accountid' => 'integer',
        'reseller_id' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function parentOrder(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'parent_order_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function commissionByOrderId(): HasMany
    {
        return $this->hasMany(Commission::class, 'order_id', 'id');
    }

    public function orderItemsByOrderId(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function ordersByOrderId(): HasMany
    {
        return $this->hasMany(Order::class, 'order_id', 'id');
    }

    public function ordersByParentOrderId(): HasMany
    {
        return $this->hasMany(Order::class, 'parent_order_id', 'id');
    }

}
