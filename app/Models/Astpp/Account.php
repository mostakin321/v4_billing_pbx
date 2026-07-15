<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends BaseAstppModel
{
    protected $table = 'accounts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'reseller_id' => 'integer',
        'pricelist_id' => 'integer',
        'paypal_permission' => 'integer',
        'status' => 'integer',
        'sweep_id' => 'integer',
        'creation' => 'datetime',
        'credit_limit' => 'decimal:6',
        'posttoexternal' => 'integer',
        'balance' => 'decimal:6',
        'country_id' => 'integer',
        'language_id' => 'integer',
        'currency_id' => 'integer',
        'maxchannels' => 'integer',
        'cps' => 'integer',
        'type' => 'integer',
        'timezone_id' => 'integer',
        'inuse' => 'integer',
        'deleted' => 'integer',
        'notify_credit_limit' => 'decimal:6',
        'notify_flag' => 'integer',
        'commission_rate' => 'integer',
        'invoice_day' => 'integer',
        'invoice_interval' => 'integer',
        'last_bill_date' => 'datetime',
        'first_used' => 'datetime',
        'expiry' => 'datetime',
        'validfordays' => 'integer',
        'local_call_cost' => 'decimal:6',
        'pass_link_status' => 'integer',
        'local_call' => 'integer',
        'is_recording' => 'integer',
        'allow_ip_management' => 'integer',
        'permission_id' => 'integer',
        'deleted_date' => 'datetime',
        'localization_id' => 'integer',
        'notifications' => 'integer',
        'is_distributor' => 'integer',
        'generate_invoice' => 'integer',
    ];

    /**
     * ASTPP's legacy schema marks nearly every column NOT NULL with no
     * default. Rather than patching every form field individually, fill
     * in safe defaults for any null attribute before saving.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $account) {
            $stringDefaults = [
                'reference', 'password', 'first_name', 'last_name',
                'company_name', 'address_1', 'address_2', 'postal_code',
                'province', 'city', 'telephone_1', 'telephone_2', 'email',
                'notification_email', 'notify_email', 'invoice_note', 'pin',
                'charge_per_min', 'std_cid_translation', 'did_cid_translation',
                'number', 'dialed_modify',
            ];

            $intDefaults = [
                'pricelist_id', 'paypal_permission', 'status', 'sweep_id',
                'posttoexternal', 'country_id', 'language_id', 'currency_id',
                'maxchannels', 'cps', 'timezone_id', 'inuse', 'deleted',
                'notify_flag', 'commission_rate', 'invoice_day',
                'invoice_interval', 'validfordays', 'pass_link_status',
                'local_call', 'is_recording', 'allow_ip_management',
                'permission_id', 'notifications', 'is_distributor',
                'generate_invoice',
            ];

            $decimalDefaults = [
                'credit_limit', 'balance', 'notify_credit_limit', 'local_call_cost',
            ];

            $datetimeDefaults = [
                'creation', 'last_bill_date', 'first_used', 'expiry', 'deleted_date',
            ];

            foreach ($stringDefaults as $field) {
                if (is_null($account->{$field})) {
                    $account->{$field} = '';
                }
            }

            foreach ($intDefaults as $field) {
                if (is_null($account->{$field})) {
                    $account->{$field} = 0;
                }
            }

            foreach ($decimalDefaults as $field) {
                if (is_null($account->{$field})) {
                    $account->{$field} = 0;
                }
            }

            foreach ($datetimeDefaults as $field) {
                if (is_null($account->{$field})) {
                    $account->{$field} = now();
                }
            }
        });
    }

    public const TYPE_ADMIN = -1;
    public const TYPE_CUSTOMER = 0;
    public const TYPE_RESELLER = 1;
    public const TYPE_PROVIDER = 3;

    public function getTypeLabelAttribute(): string
    {
        return match ((int) $this->type) {
            self::TYPE_ADMIN => 'Admin',
            self::TYPE_CUSTOMER => 'Customer',
            self::TYPE_RESELLER => 'Reseller',
            self::TYPE_PROVIDER => 'Provider',
            default => 'Other',
        };
    }

    public function scopeCustomers($query) { return $query->where('type', self::TYPE_CUSTOMER); }
    public function scopeResellers($query) { return $query->where('type', self::TYPE_RESELLER); }
    public function scopeProviders($query) { return $query->where('type', self::TYPE_PROVIDER); }

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'pricelist_id', 'id');
    }

    public function sweep(): BelongsTo
    {
        return $this->belongsTo(Sweeplist::class, 'sweep_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class, 'timezone_id', 'id');
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }

    public function localization(): BelongsTo
    {
        return $this->belongsTo(Localization::class, 'localization_id', 'id');
    }

    public function accountUnverifiedByResellerId(): HasMany
    {
        return $this->hasMany(AccountUnverified::class, 'reseller_id', 'id');
    }

    public function accountsByResellerId(): HasMany
    {
        return $this->hasMany(Account::class, 'reseller_id', 'id');
    }

    public function accountsCallerid(): HasMany
    {
        return $this->hasMany(AccountCallerid::class, 'accountid', 'id');
    }

    public function accountsCdrSummary(): HasMany
    {
        return $this->hasMany(AccountsCdrSummary::class, 'account_id', 'id');
    }

    public function accountsCdrSummaryByResellerId(): HasMany
    {
        return $this->hasMany(AccountsCdrSummary::class, 'reseller_id', 'id');
    }

    public function activityReports(): HasMany
    {
        return $this->hasMany(ActivityReport::class, 'accountid', 'id');
    }

    public function activityReportsByResellerId(): HasMany
    {
        return $this->hasMany(ActivityReport::class, 'reseller_id', 'id');
    }

    public function aniMap(): HasMany
    {
        return $this->hasMany(AniMap::class, 'accountid', 'id');
    }

    public function aniMapByResellerId(): HasMany
    {
        return $this->hasMany(AniMap::class, 'reseller_id', 'id');
    }

    public function blockPatterns(): HasMany
    {
        return $this->hasMany(BlockPattern::class, 'accountid', 'id');
    }

    public function cdrs(): HasMany
    {
        return $this->hasMany(Cdr::class, 'accountid', 'id');
    }

    public function cdrsByProviderId(): HasMany
    {
        return $this->hasMany(Cdr::class, 'provider_id', 'id');
    }

    public function cdrsByResellerId(): HasMany
    {
        return $this->hasMany(Cdr::class, 'reseller_id', 'id');
    }

    public function cdrsDayBySummary(): HasMany
    {
        return $this->hasMany(CdrsDayBySummary::class, 'account_id', 'id');
    }

    public function cdrsDayBySummaryByResellerId(): HasMany
    {
        return $this->hasMany(CdrsDayBySummary::class, 'reseller_id', 'id');
    }

    public function cdrsStaging(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'accountid', 'id');
    }

    public function cdrsStagingByProviderId(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'provider_id', 'id');
    }

    public function cdrsStagingByResellerId(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'reseller_id', 'id');
    }

    public function cliGroupByResellerId(): HasMany
    {
        return $this->hasMany(CliGroup::class, 'reseller_id', 'id');
    }

    public function commission(): HasMany
    {
        return $this->hasMany(Commission::class, 'accountid', 'id');
    }

    public function commissionByResellerId(): HasMany
    {
        return $this->hasMany(Commission::class, 'reseller_id', 'id');
    }

    public function counters(): HasMany
    {
        return $this->hasMany(Counter::class, 'accountid', 'id');
    }

    public function defaultTemplatesByResellerId(): HasMany
    {
        return $this->hasMany(DefaultTemplate::class, 'reseller_id', 'id');
    }

    public function dids(): HasMany
    {
        return $this->hasMany(Did::class, 'accountid', 'id');
    }

    public function didsByProviderId(): HasMany
    {
        return $this->hasMany(Did::class, 'provider_id', 'id');
    }

    public function gateways(): HasMany
    {
        return $this->hasMany(Gateway::class, 'accountid', 'id');
    }

    public function invoiceConf(): HasMany
    {
        return $this->hasMany(InvoiceConf::class, 'accountid', 'id');
    }

    public function invoiceConfByResellerId(): HasMany
    {
        return $this->hasMany(InvoiceConf::class, 'reseller_id', 'id');
    }

    public function invoiceDetails(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'accountid', 'id');
    }

    public function invoiceDetailsByResellerId(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'reseller_id', 'id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'accountid', 'id');
    }

    public function invoicesByResellerId(): HasMany
    {
        return $this->hasMany(Invoice::class, 'reseller_id', 'id');
    }

    public function ipMap(): HasMany
    {
        return $this->hasMany(IpMap::class, 'accountid', 'id');
    }

    public function ipMapByResellerId(): HasMany
    {
        return $this->hasMany(IpMap::class, 'reseller_id', 'id');
    }

    public function localizationList(): HasMany
    {
        return $this->hasMany(Localization::class, 'account_id', 'id');
    }

    public function localizationByResellerId(): HasMany
    {
        return $this->hasMany(Localization::class, 'reseller_id', 'id');
    }

    public function loginActivityReport(): HasMany
    {
        return $this->hasMany(LoginActivityReport::class, 'account_id', 'id');
    }

    public function mailDetails(): HasMany
    {
        return $this->hasMany(MailDetail::class, 'accountid', 'id');
    }

    public function mailDetailsByResellerId(): HasMany
    {
        return $this->hasMany(MailDetail::class, 'reseller_id', 'id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'accountid', 'id');
    }

    public function orderItemsByResellerId(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'reseller_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'accountid', 'id');
    }

    public function ordersByResellerId(): HasMany
    {
        return $this->hasMany(Order::class, 'reseller_id', 'id');
    }

    public function outboundRoutesByResellerId(): HasMany
    {
        return $this->hasMany(OutboundRoute::class, 'reseller_id', 'id');
    }

    public function paymentTransaction(): HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'accountid', 'id');
    }

    public function paymentTransactionByResellerId(): HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'reseller_id', 'id');
    }

    public function permissionsByResellerId(): HasMany
    {
        return $this->hasMany(Permission::class, 'reseller_id', 'id');
    }

    public function pricelistsByResellerId(): HasMany
    {
        return $this->hasMany(Pricelist::class, 'reseller_id', 'id');
    }

    public function productsByCreatedBy(): HasMany
    {
        return $this->hasMany(Product::class, 'created_by', 'id');
    }

    public function productsByResellerId(): HasMany
    {
        return $this->hasMany(Product::class, 'reseller_id', 'id');
    }

    public function providerCdrSummaryByProviderId(): HasMany
    {
        return $this->hasMany(ProviderCdrSummary::class, 'provider_id', 'id');
    }

    public function ratedeckByResellerId(): HasMany
    {
        return $this->hasMany(Ratedeck::class, 'reseller_id', 'id');
    }

    public function refillCoupon(): HasMany
    {
        return $this->hasMany(RefillCoupon::class, 'account_id', 'id');
    }

    public function refillCouponByResellerId(): HasMany
    {
        return $this->hasMany(RefillCoupon::class, 'reseller_id', 'id');
    }

    public function resellerCdrs(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'accountid', 'id');
    }

    public function resellerCdrsByResellerId(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'reseller_id', 'id');
    }

    public function resellerProducts(): HasMany
    {
        return $this->hasMany(ResellerProduct::class, 'account_id', 'id');
    }

    public function resellerProductsByResellerId(): HasMany
    {
        return $this->hasMany(ResellerProduct::class, 'reseller_id', 'id');
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class, 'accountid', 'id');
    }

    public function routesByResellerId(): HasMany
    {
        return $this->hasMany(Route::class, 'reseller_id', 'id');
    }

    public function sipDevicesByResellerId(): HasMany
    {
        return $this->hasMany(SipDevice::class, 'reseller_id', 'id');
    }

    public function sipDevices(): HasMany
    {
        return $this->hasMany(SipDevice::class, 'accountid', 'id');
    }

    public function sipProfiles(): HasMany
    {
        return $this->hasMany(SipProfile::class, 'accountid', 'id');
    }

    public function speedDial(): HasMany
    {
        return $this->hasMany(SpeedDial::class, 'accountid', 'id');
    }

    public function systemByResellerId(): HasMany
    {
        return $this->hasMany(SystemSetting::class, 'reseller_id', 'id');
    }

    public function taxesByResellerId(): HasMany
    {
        return $this->hasMany(Taxe::class, 'reseller_id', 'id');
    }

    public function taxesToAccounts(): HasMany
    {
        return $this->hasMany(TaxesToAccount::class, 'accountid', 'id');
    }

    public function trunksByProviderId(): HasMany
    {
        return $this->hasMany(Trunk::class, 'provider_id', 'id');
    }

}
