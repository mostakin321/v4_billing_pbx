<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CliGroup extends BaseAstppModel
{
    protected $table = 'cli_group';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'reseller_id' => 'integer',
        'assignment_method' => 'integer',
        'status' => 'integer',
        'creation_date' => 'datetime',
        'last_access_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
