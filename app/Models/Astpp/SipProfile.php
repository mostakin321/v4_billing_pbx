<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SipProfile extends BaseAstppModel
{
    protected $table = 'sip_profiles';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'created_date' => 'datetime',
        'last_modified_date' => 'datetime',
        'accountid' => 'integer',
        'status' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function gatewaysBySipProfileId(): HasMany
    {
        return $this->hasMany(Gateway::class, 'sip_profile_id', 'id');
    }

    public function sipDevicesBySipProfileId(): HasMany
    {
        return $this->hasMany(SipDevice::class, 'sip_profile_id', 'id');
    }

}
