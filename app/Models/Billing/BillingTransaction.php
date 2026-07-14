<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingTransaction extends Model
{
    protected $table      = 'billing_transactions';
    public    $timestamps = false;

    protected $fillable = [
        'account_id', 'cdr_id', 'type',
        'amount', 'balance_before', 'balance_after',
        'description', 'reference_type', 'reference_id', 'created_at',
    ];

    protected $casts = [
        'amount'         => 'decimal:5',
        'balance_before' => 'decimal:5',
        'balance_after'  => 'decimal:5',
        'created_at'     => 'datetime',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
