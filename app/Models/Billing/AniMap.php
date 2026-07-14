<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ANI Map = Caller ID mapping per account
 * Maps inbound caller numbers to accounts
 */
class AniMap extends BaseBillingModel
{
    protected $table = 'ani_map';

    protected $fillable = [
        'number', 'accountid', 'reseller_id', 'status', 'context',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id');
    }
}
