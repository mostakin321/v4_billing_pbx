<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use App\Models\RoutingEntry;
use App\Services\Routing\RoutingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteGroupController extends Controller
{
    public function lookupActiveRoute(Request $request, RoutingService $routing): JsonResponse
    {
        $v = $request->validate([
            'cgrates_account_id' => 'required|string',
            'destination' => 'required|string',
        ]);

        try {
            return response()->json([
                'success' => true,
                'data' => $routing->determineOutboundRoute($v['cgrates_account_id'], $v['destination']),
            ]);
        } catch (\Throwable $e) {
            return response()->json(['success'=>false,'message'=>$e->getMessage()], 422);
        }
    }

    public function storeRouteEntry(Request $request): JsonResponse
    {
        $v = $request->validate([
            'route_group_id' => 'required|uuid',
            'carrier_id' => 'required|uuid',
            'gateway_id' => 'required|uuid',
            'prefix' => 'required|string',
            'priority' => 'required|integer|min:1',
            'vendor_rate' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $entry = RoutingEntry::updateOrCreate(
            [
                'route_group_id' => $v['route_group_id'],
                'prefix' => $v['prefix'],
                'gateway_id' => $v['gateway_id'],
            ],
            $v
        );

        return response()->json(['success'=>true,'entry_id'=>$entry->id]);
    }
}
