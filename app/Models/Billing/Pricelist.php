<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pricelist extends BaseBillingModel
{
    protected $table = 'pricelists';

    protected $fillable = [
        'name', 'markup', 'routing_type', 'initially_increment',
        'inc', 'status', 'reseller_id', 'pricelist_id_admin',
        'routing_prefix',
    ];

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id');
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class, 'pricelist_id');
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'pricelist_id');
    }
}
