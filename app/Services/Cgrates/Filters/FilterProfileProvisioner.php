<?php

namespace App\Services\Cgrates\Filters;

use App\Models\Cgrates\TpFilter;

class FilterProfileProvisioner
{
    public function upsert(array $payload, string $tpid = 'default'): TpFilter
    {
        return TpFilter::updateOrCreate(
            [
                'tpid' => $tpid,
                'tenant' => $payload['tenant'],
                'id' => $payload['id'],
                'type' => $payload['type'],
                'element' => $payload['element'],
            ],
            [
                'values' => is_array($payload['values']) ? implode(',', $payload['values']) : $payload['values'],
                'activation_interval' => $payload['activation_interval'] ?? '*any',
            ]
        );
    }
}
