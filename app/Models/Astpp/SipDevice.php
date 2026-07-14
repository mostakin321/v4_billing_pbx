<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SipDevice extends BaseAstppModel
{
    protected $table = 'sip_devices';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'sip_profile_id' => 'integer',
        'reseller_id' => 'integer',
        'accountid' => 'integer',
        'status' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
        'call_waiting' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function sipProfile(): BelongsTo
    {
        return $this->belongsTo(SipProfile::class, 'sip_profile_id', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

}
