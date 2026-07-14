<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingCdr extends Model
{
    protected $table = 'cdrs';
    public    $timestamps = false;

    protected $fillable = [
        'uuid', 'account_id', 'account_number', 'reseller_id', 'trunk_id',
        'caller_number', 'destination_number', 'call_direction',
        'start_time', 'answer_time', 'end_time',
        'duration', 'billsec', 'billed_seconds',
        'rate', 'sell_rate', 'buy_rate', 'connectcost',
        'reseller_cost', 'call_cost', 'connect_cost',
        'init_inc', 'inc', 'pricelist_id', 'nibble_total',
        'status', 'hangup_cause', 'bill_status',
        'did_id', 'created_at',
    ];

    protected $casts = [
        'start_time'  => 'datetime',
        'answer_time' => 'datetime',
        'end_time'    => 'datetime',
        'call_cost'   => 'decimal:5',
        'sell_rate'   => 'decimal:5',
        'buy_rate'    => 'decimal:5',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
