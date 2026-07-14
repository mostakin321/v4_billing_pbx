<?php

namespace App\Models\FusionPBX;

use Illuminate\Database\Eloquent\Relations\HasMany;

class RingGroup extends BaseFusionPbxModel
{
    protected $table = 'v_ring_groups';
    protected $primaryKey = 'ring_group_uuid';

    protected $casts = [
        'ring_group_call_timeout' => 'float',
    ];

    public function destinations(): HasMany
    {
        return $this->hasMany(RingGroupDestination::class, 'ring_group_uuid', 'ring_group_uuid')
                    ->orderBy('destination_delay');
    }
}
