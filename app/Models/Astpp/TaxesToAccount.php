<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxesToAccount extends BaseAstppModel
{
    protected $table = 'taxes_to_accounts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'taxes_id' => 'integer',
        'taxes_priority' => 'integer',
        'assign_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function tax(): BelongsTo
    {
        return $this->belongsTo(Taxe::class, 'taxes_id', 'id');
    }

}
