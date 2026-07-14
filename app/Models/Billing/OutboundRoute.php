<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutboundRoute extends BaseBillingModel
{
    protected $table = 'outbound_routes';

    protected $fillable = [
        'pattern', 'comment', 'connectcost', 'includedseconds',
        'cost', 'trunk_id', 'inc', 'strip', 'prepend',
        'precedence', 'reseller_id', 'status', 'init_inc',
        'creation_date', 'last_modified_date',
    ];

    protected $casts = [
        'cost'        => 'decimal:5',
        'connectcost' => 'decimal:5',
        'status'      => 'integer',
    ];

    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id');
    }
}
