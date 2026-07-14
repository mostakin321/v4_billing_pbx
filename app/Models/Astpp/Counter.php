<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Counter extends BaseAstppModel
{
    protected $table = 'counters';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'product_id' => 'integer',
        'package_id' => 'integer',
        'accountid' => 'integer',
        'used_seconds' => 'integer',
        'type' => 'integer',
        'status' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function packageProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'package_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

}
