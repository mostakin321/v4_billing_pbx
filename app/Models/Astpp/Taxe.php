<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Taxe extends BaseAstppModel
{
    protected $table = 'taxes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'taxes_priority' => 'integer',
        'taxes_amount' => 'decimal:6',
        'tax_type' => 'integer',
        'taxes_rate' => 'decimal:6',
        'reseller_id' => 'integer',
        'last_modified_date' => 'datetime',
        'creation_date' => 'datetime',
        'status' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function taxesToAccountsByTaxesId(): HasMany
    {
        return $this->hasMany(TaxesToAccount::class, 'taxes_id', 'id');
    }

}
