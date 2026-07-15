<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use App\Services\Inbound\InboundRoutingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InboundDidController extends Controller
{
    public function routeIncomingCall(Request $request, InboundRoutingService $inbound): JsonResponse
    {
        $v = $request->validate([
            'destination_number' => 'required|string',
        ]);

        try {
            $route = $inbound->resolveInboundDestination($v['destination_number']);

            return response()->json([
                'success' => true,
                'message' => 'Inbound DID route resolved',
                'routing' => [
                    'domain_uuid' => $route['domain_uuid'],
                    'domain_name' => $route['domain_name'],
                    'cgrates_account_id' => $route['cgrates_account_id'],
                    'dial_string' => $route['dial_string'],
                    'route_type' => $route['route_type'],
                    'export_vars' => [
                        'cgr_tenant' => explode(':', $route['cgrates_account_id'])[0],
                        'cgr_account' => explode(':', $route['cgrates_account_id'])[1] ?? 'inbound',
                        'billing_strategy' => $route['is_metered'] ? 'metered_1_1' : 'flat_rate',
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
