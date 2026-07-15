<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use App\Services\CGRateS\JsonRpcClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TariffManagementController extends Controller
{
    public function syncTariffProfile(Request $request, JsonRpcClient $cgrates): JsonResponse
    {
        $v = $request->validate([
            'tpid' => 'required|string',
            'prefix' => 'required|string',
            'destination_id' => 'nullable|string',
            'rate_id' => 'nullable|string',
            'rate' => 'required|numeric|min:0',
            'connect_fee' => 'nullable|numeric|min:0',
            'rate_unit' => 'nullable|string',
            'rate_increment' => 'nullable|string',
            'group_interval_start' => 'nullable|string',
        ]);

        $destId = $v['destination_id'] ?? 'DST_'.$v['prefix'];
        $rateId = $v['rate_id'] ?? 'RATE_'.$v['tpid'].'_'.$v['prefix'];

        $dest = $cgrates->call('ApierV2.SetTPDestination', [[
            'TPid' => $v['tpid'],
            'ID' => $destId,
            'Prefixes' => [$v['prefix']],
        ]]);

        $rate = $cgrates->call('ApierV1.SetTPRate', [[
            'TPid' => $v['tpid'],
            'ID' => $rateId,
            'RateSlots' => [[
                'ConnectFee' => (float) ($v['connect_fee'] ?? 0),
                'Rate' => (float) $v['rate'],
                'RateUnit' => $v['rate_unit'] ?? '60s',
                'RateIncrement' => $v['rate_increment'] ?? '1s',
                'GroupIntervalStart' => $v['group_interval_start'] ?? '0s',
            ]],
        ]]);

        return response()->json([
            'success' => true,
            'message' => 'Tariff destination and rate synced to CGRateS',
            'destination_id' => $destId,
            'rate_id' => $rateId,
            'cgrates' => [
                'destination' => $dest,
                'rate' => $rate,
            ],
        ]);
    }
}
