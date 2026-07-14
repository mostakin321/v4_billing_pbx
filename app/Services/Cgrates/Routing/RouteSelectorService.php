<?php

namespace App\Services\Cgrates\Routing;

use App\Models\Cgrates\TpRoute;
use Illuminate\Support\Collection;

class RouteSelectorService
{
    public function candidates(string $tenant, string $routeId): Collection
    {
        return TpRoute::query()
            ->where('tenant', $tenant)
            ->where('route_id', $routeId)
            ->orderByDesc('weight')
            ->get();
    }
}
