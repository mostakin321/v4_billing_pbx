<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Did extends BaseAstppModel
{
    protected $table = 'dids';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'accountid' => 'integer',
        'parent_id' => 'integer',
        'connectcost' => 'decimal:6',
        'includedseconds' => 'integer',
        'monthlycost' => 'decimal:6',
        'cost' => 'decimal:6',
        'init_inc' => 'integer',
        'inc' => 'integer',
        'status' => 'integer',
        'provider_id' => 'integer',
        'country_id' => 'integer',
        'setup' => 'decimal:6',
        'maxchannels' => 'integer',
        'call_type' => 'integer',
        'leg_timeout' => 'integer',
        'product_id' => 'integer',
        'always' => 'integer',
        'user_busy' => 'integer',
        'user_not_registered' => 'integer',
        'no_answer' => 'integer',
        'failover_call_type' => 'integer',
        'always_vm_flag' => 'integer',
        'user_busy_vm_flag' => 'integer',
        'user_not_registered_vm_flag' => 'integer',
        'no_answer_vm_flag' => 'integer',
        'call_type_vm_flag' => 'integer',
        'last_modified_date' => 'datetime',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'accountid', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Did::class, 'parent_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'provider_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(CountryCode::class, 'country_id', 'id');
    }

    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'call_type', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function didsByParentId(): HasMany
    {
        return $this->hasMany(Did::class, 'parent_id', 'id');
    }

}
