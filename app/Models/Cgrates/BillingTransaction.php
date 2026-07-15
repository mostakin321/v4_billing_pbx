<?php

namespace App\Models\Cgrates;

class BillingTransaction extends CgratesModel
{
    protected $connection = 'astpp';

    protected $table = 'billing_transactions';

    public $timestamps = true;

    /**
     * The legacy ASTPP table contains created_at only.
     */
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $fillable = [
        'account_id',
        'cdr_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
        'reference_type',
        'reference_id',
    ];

    protected $casts = [
        'amount' => 'decimal:6',
        'balance_before' => 'decimal:6',
        'balance_after' => 'decimal:6',
        'created_at' => 'datetime',
    ];
}
