<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutboundRoute extends BaseAstppModel
{
    protected $table = 'outbound_routes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'connectcost' => 'decimal:6',
        'includedseconds' => 'integer',
        'cost' => 'decimal:6',
        'trunk_id' => 'integer',
        'inc' => 'integer',
        'precedence' => 'integer',
        'reseller_id' => 'integer',
        'status' => 'integer',
        'init_inc' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
