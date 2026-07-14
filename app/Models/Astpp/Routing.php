<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Routing extends BaseAstppModel
{
    protected $table = 'routing';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'pricelist_id' => 'integer',
        'trunk_id' => 'integer',
        'routes_id' => 'integer',
        'call_count' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id', 'id');
    }

    public function trunk(): BelongsTo
    {
        return $this->belongsTo(Trunk::class, 'trunk_id', 'id');
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class, 'routes_id', 'id');
    }

}
