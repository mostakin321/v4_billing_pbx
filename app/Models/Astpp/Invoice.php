<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends BaseAstppModel
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'reseller_id' => 'integer',
        'payment_id' => 'integer',
        'from_date' => 'datetime',
        'to_date' => 'datetime',
        'due_date' => 'datetime',
        'status' => 'integer',
        'generate_date' => 'datetime',
        'generate_type' => 'integer',
        'confirm' => 'integer',
        'is_deleted' => 'integer',
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

    public function paymentTransaction(): BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class, 'payment_id', 'id');
    }

    public function cdrsByInvoiceid(): HasMany
    {
        return $this->hasMany(Cdr::class, 'invoiceid', 'id');
    }

    public function cdrsStagingByInvoiceid(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'invoiceid', 'id');
    }

    public function invoiceDetailsByInvoiceid(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoiceid', 'id');
    }

}
