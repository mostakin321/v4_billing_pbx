<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'code', 'name', 'billing_type', 'unit_cost',
        'unit_label', 'currency_id', 'status', 'description',
    ];

    protected $casts = [
        'unit_cost' => 'decimal:6',
        'status'    => 'integer',
    ];

    public function accountServices(): HasMany
    {
        return $this->hasMany(AccountService::class);
    }

    public function usageLogs(): HasMany
    {
        return $this->hasMany(ServiceUsage::class);
    }
}
