<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DidCallType extends BaseAstppModel
{
    protected $table = 'did_call_types';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [

    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'call_type', 'id');
    }

}
