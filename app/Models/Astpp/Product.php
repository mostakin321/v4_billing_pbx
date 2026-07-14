<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseAstppModel
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'country_id' => 'integer',
        'product_category' => 'integer',
        'buy_cost' => 'decimal:6',
        'price' => 'decimal:6',
        'setup_fee' => 'decimal:6',
        'can_resell' => 'integer',
        'commission' => 'decimal:6',
        'billing_type' => 'integer',
        'billing_days' => 'integer',
        'free_minutes' => 'integer',
        'applicable_for' => 'integer',
        'apply_on_existing_account' => 'integer',
        'release_no_balance' => 'integer',
        'can_purchase' => 'integer',
        'status' => 'integer',
        'is_deleted' => 'integer',
        'created_by' => 'integer',
        'reseller_id' => 'integer',
        'creation_date' => 'datetime',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'created_by', 'id');
    }

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

    public function cdrsByPackageId(): HasMany
    {
        return $this->hasMany(Cdr::class, 'package_id', 'id');
    }

    public function cdrsStagingByPackageId(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'package_id', 'id');
    }

    public function commissionByProductId(): HasMany
    {
        return $this->hasMany(Commission::class, 'product_id', 'id');
    }

    public function countersByProductId(): HasMany
    {
        return $this->hasMany(Counter::class, 'product_id', 'id');
    }

    public function countersByPackageId(): HasMany
    {
        return $this->hasMany(Counter::class, 'package_id', 'id');
    }

    public function didsByProductId(): HasMany
    {
        return $this->hasMany(Did::class, 'product_id', 'id');
    }

    public function orderItemsByProductId(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function packagePatternsByProductId(): HasMany
    {
        return $this->hasMany(PackagePattern::class, 'product_id', 'id');
    }

    public function resellerCdrsByPackageId(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'package_id', 'id');
    }

    public function resellerProductsByProductId(): HasMany
    {
        return $this->hasMany(ResellerProduct::class, 'product_id', 'id');
    }

}
