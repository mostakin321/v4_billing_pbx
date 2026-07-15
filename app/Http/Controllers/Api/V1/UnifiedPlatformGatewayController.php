<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\UnifiedCdr;
use App\Services\Billing\RatingService;
use App\Services\Wallet\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UnifiedPlatformGatewayController extends Controller
{
    public function processHangupWebhook(Request $request, RatingService $rating, WalletService $wallet): JsonResponse
    {
        $p = $request->validate([
            'xml_cdr_uuid' => 'required|uuid',
            'cgrates_account_id' => 'required|string',
            'domain_uuid' => 'nullable|uuid',
            'extension_uuid' => 'nullable|uuid',
            'domain_name' => 'nullable|string',
            'direction' => 'required|string',
            'caller_id_number' => 'required|string',
            'destination_number' => 'required|string',
            'start_epoch' => 'required|integer',
            'answer_epoch' => 'nullable|integer',
            'end_epoch' => 'required|integer',
            'start_stamp' => 'required|string',
            'answer_stamp' => 'nullable|string',
            'end_stamp' => 'required|string',
            'duration' => 'required|integer',
            'billsec' => 'required|integer',
            'hangup_cause' => 'required|string',
        ]);

        $cost = $rating->getVoiceCost($p);

        UnifiedCdr::updateOrCreate(
            ['xml_cdr_uuid' => $p['xml_cdr_uuid']],
            [
                'cgrates_account_id' => $p['cgrates_account_id'],
                'domain_uuid' => $p['domain_uuid'] ?? null,
                'extension_uuid' => $p['extension_uuid'] ?? null,
                'domain_name' => $p['domain_name'] ?? null,
                'direction' => $p['direction'],
                'caller_id_number' => $p['caller_id_number'],
                'destination_number' => $p['destination_number'],
                'start_epoch' => $p['start_epoch'],
                'answer_epoch' => $p['answer_epoch'] ?? null,
                'end_epoch' => $p['end_epoch'],
                'start_stamp' => Carbon::parse($p['start_stamp']),
                'answer_stamp' => !empty($p['answer_stamp']) ? Carbon::parse($p['answer_stamp']) : null,
                'end_stamp' => Carbon::parse($p['end_stamp']),
                'duration' => $p['duration'],
                'billsec' => $p['billsec'],
                'cost' => $cost,
                'hangup_cause' => $p['hangup_cause'],
            ]
        );

        if ($cost > 0) {
            $wallet->debit($p['cgrates_account_id'], $cost, $p['xml_cdr_uuid'], 'Voice CDR debit');
        }

        return response()->json([
            'success' => true,
            'message' => 'CDR processed',
            'cost' => $cost,
        ], 202);
    }
}
