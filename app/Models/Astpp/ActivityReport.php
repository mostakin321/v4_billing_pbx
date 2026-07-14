<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityReport extends BaseAstppModel
{
    protected $table = 'activity_reports';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'reseller_id' => 'integer',
        'last_did_call_time' => 'datetime',
        'last_outbound_call_time' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
