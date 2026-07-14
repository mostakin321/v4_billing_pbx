<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Rate model — maps to ASTPP 'routes' table (origination/sell rates).
 * Not to be confused with outbound_routes (termination/buy rates).
 */
class Rate extends BaseBillingModel
{
    protected $table = 'routes';

    protected $fillable = [
        'pattern', 'comment', 'connectcost', 'includedseconds',
        'cost', 'pricelist_id', 'inc', 'country_id', 'call_type',
        'routing_type', 'percentage', 'call_count',
        'accountid', 'reseller_id', 'precedence', 'status',
        'trunk_id', 'init_inc',
        'creation_date', 'last_modified_date',
    ];

    protected $casts = [
        'cost'        => 'decimal:5',
        'connectcost' => 'decimal:5',
        'status'      => 'integer',
    ];

    public $timestamps = false;

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id');
    }
}
