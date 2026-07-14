<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * IP Map = IP-based authentication for accounts
 * Allows accounts to authenticate by IP instead of password
 */
class IpMap extends BaseBillingModel
{
    protected $table = 'ip_map';

    public const CREATED_AT = 'created_date';
    public const UPDATED_AT = 'last_modified_date';

    protected $fillable = [
        'name', 'ip', 'accountid', 'reseller_id',
        'pricelist_id', 'prefix', 'context', 'status',
    ];

    protected $casts = [
        'created_date' => 'datetime',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid');
    }

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id');
    }
}
