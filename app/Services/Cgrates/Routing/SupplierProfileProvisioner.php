<?php

namespace App\Services\Cgrates\Routing;

use App\DTO\SupplierProfileData;
use App\Models\Cgrates\TpRoute;

class SupplierProfileProvisioner
{
    public function replaceRoutes(SupplierProfileData $data, string $tpid = 'default'): void
    {
        TpRoute::query()
            ->where('tpid', $tpid)
            ->where('tenant', $data->tenant)
            ->where('route_id', $data->profileId)
            ->delete();

        foreach ($data->routes ?? [] as $index => $route) {
            TpRoute::create([
                'tpid' => $tpid,
                'tenant' => $data->tenant,
                'route_id' => $data->profileId,
                'filter_ids' => implode(',', $route['filter_ids'] ?? $data->filterIds ?? []),
                'sorting' => $data->sorting,
                'sorting_parameters' => is_array($data->sortingParameters) ? implode(',', $data->sortingParameters) : (string) $data->sortingParameters,
                'route_parameters' => $route['route_parameters'] ?? '',
                'weight' => $route['weight'] ?? ($data->weight ?? 0),
            ]);
        }
    }
}
