<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use App\Jobs\GatewayRegisterSyncJob;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GatewaySyncController extends Controller
{
    /**
     * POST /api/v1/fusion-pbx/gateways/resync
     */
    public function triggerGatewayResync(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'gateway_name' => 'required|string',
            'profile_name' => 'required|string',
        ]);

        GatewayRegisterSyncJob::dispatch(
            $validated['gateway_name'],
            $validated['profile_name']
        );

        return response()->json([
            'success' => true,
            'message' => "Registration sync dispatched for {$validated['gateway_name']}.",
        ], 202);
    }

    /**
     * GET /api/v1/fusion-pbx/gateways/status
     */
    public function queryLiveRegistrationStatus(Request $request): JsonResponse
    {
        $request->validate([
            'gateway_name' => 'required|string',
            'profile_name' => 'required|string',
        ]);

        $gateway = $request->query('gateway_name');
        $profile = $request->query('profile_name');

        $eslSocket = @fsockopen("127.0.0.1", 8021, $errNo, $errStr, 3);

        if (!$eslSocket) {
            return response()->json([
                'success' => false,
                'status' => 'UNKNOWN_ESL_DOWN'
            ], 500);
        }

        fputs($eslSocket, "auth ClueCon_Production_Changes_2026\n\n");
        fgets($eslSocket, 1024);

        fputs($eslSocket, "api sofia xmlstatus profile {$profile}\n\n");

        $rawXmlResponse = "";

        while (!feof($eslSocket)) {
            $line = fgets($eslSocket, 4096);
            $rawXmlResponse .= $line;

            if (str_contains($line, "</profile>")) {
                break;
            }
        }

        fclose($eslSocket);

        $cleanXml = strstr($rawXmlResponse, "<profile>");

        if ($cleanXml && ($xml = simplexml_load_string($cleanXml))) {

            foreach ($xml->gateways->gateway as $gw) {

                if ((string) $gw->name === $gateway) {

                    return response()->json([
                        'success' => true,
                        'gateway' => $gateway,
                        'status'  => strtoupper((string) $gw->status),
                        'ping'    => (string) $gw->ping,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'status' => 'NOT_FOUND'
        ], 404);
    }
}
