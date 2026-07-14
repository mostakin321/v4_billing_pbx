<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailDetail extends BaseAstppModel
{
    protected $table = 'mail_details';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'date' => 'datetime',
        'status' => 'integer',
        'reseller_id' => 'integer',
        'status_code' => 'integer',
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
