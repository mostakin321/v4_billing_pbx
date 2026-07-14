<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    protected $table = 'accounts';
    public $timestamps = false;

    protected $fillable = [
        'number', 'reseller_id', 'status',
        'balance', 'credit_limit', 'posttoexternal',
        'first_name', 'last_name', 'company_name',
        'email', 'notification_email',
        'telephone_1', 'telephone_2',
        'address_1', 'address_2', 'postal_code',
        'province', 'city', 'country_id',
        'maxchannels', 'cps', 'type',
        'currency_id', 'language_id', 'timezone_id',
        'is_recording', 'allow_ip_management',
        'deleted', 'expiry', 'validfordays',
        'notify_credit_limit', 'notify_email', 'notify_flag',
        'commission_rate', 'generate_invoice',
        'invoice_day', 'invoice_interval',
        'pin', 'tax_number',
        'dialed_modify', 'charge_per_min',
        'std_cid_translation', 'did_cid_translation',
        'permission_id', 'localization_id',
        'sweep_id', 'local_call', 'local_call_cost',
        'pass_link_status', 'is_distributor', 'paypal_permission',
        // Extended fields (add via migration if needed)
        'domain_uuid', 'user_uuid', 'extension', 'fx_group',
    ];

    protected $casts = [
        'balance'      => 'decimal:5',
        'credit_limit' => 'decimal:5',
        'expiry'       => 'datetime',
        'deleted'      => 'boolean',
    ];

    // Type constants
    const TYPE_ADMIN    = -1;
    const TYPE_RESELLER =  3;
    const TYPE_CUSTOMER =  0;
    const TYPE_PROVIDER =  2;

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(self::class, 'reseller_id');
    }

    public function customers(): HasMany
    {
        return $this->hasMany(self::class, 'reseller_id');
    }

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id');
    }

    public function cdrs(): HasMany
    {
        return $this->hasMany(BillingCdr::class, 'account_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(BillingTransaction::class, 'account_id');
    }

    public function dids(): HasMany
    {
        // dids.accountid references accounts.id
        return $this->hasMany(Did::class, 'accountid');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'accountid');
    }

    public function getAvailableBalanceAttribute(): float
    {
        return (float) $this->balance + (float) $this->credit_limit;
    }

    public function getTypeLabelAttribute(): string
    {
        return match ((int) $this->type) {
            self::TYPE_ADMIN    => 'Admin',
            self::TYPE_RESELLER => 'Reseller',
            self::TYPE_CUSTOMER => 'Customer',
            self::TYPE_PROVIDER => 'Provider',
            default             => 'Unknown',
        };
    }

    // Scopes
    public function scopeActive($q)    { return $q->where('status', 0)->where('deleted', 0); }
    public function scopeResellers($q) { return $q->where('type', self::TYPE_RESELLER); }
    public function scopeCustomers($q) { return $q->where('type', self::TYPE_CUSTOMER); }
    public function scopeProviders($q) { return $q->where('type', self::TYPE_PROVIDER); }
}
