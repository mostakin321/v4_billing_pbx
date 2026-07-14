<?php

namespace App\Models\FusionPBX;

use Illuminate\Database\Eloquent\Builder;

/**
 * Scoped view of v_dialplans — outbound routes only.
 * Mirrors FusionPBX app_uuid: 8c914ec3-9fc0-8ab5-4cda-6c9288bdc9a3
 * Excludes the helper 'call_direction-outbound' companion entries.
 */
class OutboundRoute extends Dialplan
{
    const OUTBOUND_APP_UUID = '8c914ec3-9fc0-8ab5-4cda-6c9288bdc9a3';

    protected static function booted(): void
    {
        static::addGlobalScope('outbound_routes', function (Builder $query) {
            $query->where('app_uuid', self::OUTBOUND_APP_UUID)
                  ->where('dialplan_name', 'not like', 'call_direction-outbound%')
                  ->where('dialplan_context', '!=', 'public');
        });
    }
}
