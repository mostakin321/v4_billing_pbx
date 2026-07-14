<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseBillingModel
{
    protected $table = 'products';

    const CAT_PACKAGE      = 1;
    const CAT_SUBSCRIPTION = 2;
    const CAT_REFILL       = 3;
    const CAT_DID          = 4;

    protected $fillable = [
        'name', 'country_id', 'description', 'product_category',
        'buy_cost', 'price', 'setup_fee', 'can_resell', 'commission',
        'billing_type', 'billing_days', 'free_minutes',
        'applicable_for', 'apply_on_existing_account',
        'apply_on_rategroups', 'destination_rategroups',
        'destination_countries', 'destination_calltypes',
        'release_no_balance', 'can_purchase', 'status',
        'is_deleted', 'created_by', 'reseller_id',
    ];

    protected $casts = [
        'price'      => 'decimal:5',
        'buy_cost'   => 'decimal:5',
        'setup_fee'  => 'decimal:5',
        'can_purchase' => 'boolean',
        'can_resell'   => 'boolean',
        'is_deleted'   => 'boolean',
    ];

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    public function getCategoryNameAttribute(): string
    {
        return match ((int)$this->product_category) {
            self::CAT_PACKAGE      => 'Package',
            self::CAT_SUBSCRIPTION => 'Subscription',
            self::CAT_REFILL       => 'Refill',
            self::CAT_DID          => 'DID',
            default                => 'Unknown',
        };
    }
}
