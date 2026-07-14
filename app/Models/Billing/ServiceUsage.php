<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceUsage extends Model
{
    protected $table = 'service_usage';

    protected $fillable = [
        'account_id', 'service_id', 'service_code',
        'units', 'unit_cost', 'total_cost',
        'reference_id', 'metadata',
    ];

    protected $casts = [
        'units'      => 'decimal:6',
        'unit_cost'  => 'decimal:6',
        'total_cost' => 'decimal:6',
        'metadata'   => 'array',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
