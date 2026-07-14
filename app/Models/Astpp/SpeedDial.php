<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpeedDial extends BaseAstppModel
{
    protected $table = 'speed_dial';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'speed_num' => 'integer',
        'accountid' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

}
