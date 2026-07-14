<?php

namespace App\Services\Cgrates\Charging;

use App\DTO\ChargingProfileData;
use App\Models\Cgrates\TpCharger;

class ChargingProfileProvisioner
{
    public function upsert(ChargingProfileData $data, string $tpid = 'default'): TpCharger
    {
        return TpCharger::updateOrCreate(
            [
                'tpid' => $tpid,
                'tenant' => $data->tenant,
                'id' => $data->id,
                'run_id' => $data->runId,
            ],
            [
                'filter_ids' => is_array($data->filterIds) ? implode(',', $data->filterIds) : $data->filterIds,
                'attribute_ids' => is_array($data->attributeIds) ? implode(',', $data->attributeIds) : $data->attributeIds,
                'activation_interval' => '*any',
                'weight' => $data->weight,
            ]
        );
    }
}
