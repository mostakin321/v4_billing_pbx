<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Did model — maps to ASTPP 6.0 `dids` table.
 * Column: accountid (NOT account_id)
 */
class Did extends Model
{
    protected $table = 'dids';
    public $timestamps = false;

    protected $fillable = [
        'number', 'accountid', 'parent_id',
        'connectcost', 'includedseconds', 'monthlycost',
        'cost', 'init_inc', 'inc', 'extensions',
        'status', 'provider_id', 'country_id',
        'province', 'city', 'setup', 'maxchannels',
        'call_type', 'leg_timeout', 'product_id',
        'always', 'always_destination',
        'user_busy', 'user_busy_destination',
        'user_not_registered', 'user_not_registered_destination',
        'no_answer', 'no_answer_destination',
        'failover_extensions', 'failover_call_type',
        'always_vm_flag', 'user_busy_vm_flag',
        'user_not_registered_vm_flag', 'no_answer_vm_flag',
        'call_type_vm_flag', 'last_modified_date',
    ];

    protected $casts = [
        'connectcost'  => 'decimal:5',
        'monthlycost'  => 'decimal:5',
        'cost'         => 'decimal:5',
        'setup'        => 'decimal:5',
        'last_modified_date' => 'datetime',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'provider_id');
    }
}
