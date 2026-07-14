<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceConf extends BaseAstppModel
{
    protected $table = 'invoice_conf';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'invoice_start_from' => 'integer',
        'invoice_due_notification' => 'integer',
        'invoice_notification' => 'integer',
        'no_usage_invoice' => 'integer',
        'notify_before_day' => 'integer',
        'reseller_id' => 'integer',
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
