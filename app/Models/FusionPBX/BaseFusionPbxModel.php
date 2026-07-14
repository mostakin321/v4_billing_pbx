<?php

namespace App\Models\FusionPBX;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Base model for FusionPBX tables (MySQL converted).
 *
 * - Primary keys are UUID strings.
 * - Timestamps use insert_date / update_date (FusionPBX convention).
 */
abstract class BaseFusionPbxModel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $connection = 'fusionpbx';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    public $timestamps = true;

    public const CREATED_AT = 'insert_date';
    public const UPDATED_AT = 'update_date';

    protected $casts = [
        'insert_date' => 'datetime',
        'update_date' => 'datetime',
    ];
}
