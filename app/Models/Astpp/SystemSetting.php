<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemSetting extends BaseAstppModel
{
    protected $table = 'system';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'timestamp' => 'datetime',
        'reseller_id' => 'integer',
        'is_display' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function reseller(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'reseller_id', 'id');
    }

}
