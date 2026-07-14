<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ratedeck extends BaseBillingModel
{
    protected $table = 'ratedeck';

    protected $fillable = [
        'reseller_id', 'description', 'pattern',
        'destination', 'call_type', 'country_id',
        'cost', 'init_inc', 'inc', 'status',
    ];

    protected $casts = [
        'cost' => 'decimal:5',
    ];

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_modified_date';

    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id');
    }
}
