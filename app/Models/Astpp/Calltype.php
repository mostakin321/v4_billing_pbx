<?php

namespace App\Models\Astpp;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calltype extends BaseAstppModel
{
    protected $table = 'calltype';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $casts = [
        'date' => 'datetime',
        'status' => 'integer',
    ];

    // Relationships are inferred from ASTPP's legacy schema column names.
    public function calltype(): BelongsTo
    {
        return $this->belongsTo(Calltype::class, 'call_type', 'id');
    }

    public function calltypeByCallType(): HasMany
    {
        return $this->hasMany(Calltype::class, 'call_type', 'id');
    }

    public function cdrsByCalltype(): HasMany
    {
        return $this->hasMany(Cdr::class, 'calltype', 'id');
    }

    public function cdrsStagingByCalltype(): HasMany
    {
        return $this->hasMany(CdrsStaging::class, 'calltype', 'id');
    }

    public function didCallTypesByCallType(): HasMany
    {
        return $this->hasMany(DidCallType::class, 'call_type', 'id');
    }

    public function didsByCallType(): HasMany
    {
        return $this->hasMany(Did::class, 'call_type', 'id');
    }

    public function ratedeckByCallType(): HasMany
    {
        return $this->hasMany(Ratedeck::class, 'call_type', 'id');
    }

    public function resellerCdrsByCalltype(): HasMany
    {
        return $this->hasMany(ResellerCdr::class, 'calltype', 'id');
    }

    public function routesByCallType(): HasMany
    {
        return $this->hasMany(Route::class, 'call_type', 'id');
    }

}
