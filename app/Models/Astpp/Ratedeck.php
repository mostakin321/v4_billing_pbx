<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ratedeck extends BaseAstppModel
{
    protected $table = 'ratedeck';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'country_id' => 'integer',
        'status' => 'integer',
        'reseller_id' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'call_type', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
