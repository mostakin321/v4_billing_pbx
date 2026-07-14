<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagePattern extends BaseAstppModel
{
    protected $table = 'package_patterns';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'product_id' => 'integer',
        'country_id' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

}
