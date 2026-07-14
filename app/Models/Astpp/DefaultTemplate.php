<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DefaultTemplate extends BaseAstppModel
{
    protected $table = 'default_templates';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'last_modified_date' => 'datetime',
        'reseller_id' => 'integer',
        'is_email_enable' => 'integer',
        'is_sms_enable' => 'integer',
        'is_alert_enable' => 'integer',
        'status' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
