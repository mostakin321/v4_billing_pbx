<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Route extends BaseBillingModel
{
    protected $table = 'routes';

    protected $fillable = [
        'pattern', 'comment', 'connectcost', 'includedseconds',
        'cost', 'pricelist_id', 'inc', 'country_id', 'call_type',
        'routing_type', 'reseller_id', 'precedence', 'status',
        'trunk_id', 'init_inc',
    ];

    protected $casts = [
        'cost'        => 'decimal:5',
        'connectcost' => 'decimal:5',
    ];

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id');
    }
}
