<?php
namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessNumber extends BaseBillingModel
{
    protected $table = 'accessnumber';

    protected $fillable = [
        'access_number', 'country_id', 'description', 'status',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(\Illuminate\Support\Facades\DB::table('countrycode'), 'country_id');
    }
}
