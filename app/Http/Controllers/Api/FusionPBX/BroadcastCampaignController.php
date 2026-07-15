<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use App\Models\VoiceBroadcastCampaign;
use App\Models\VoiceBroadcastTarget;
use App\Services\Broadcast\VoiceBroadcastService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BroadcastCampaignController extends Controller
{
    public function createCampaign(Request $request): JsonResponse
    {
        $v = $request->validate([
            'account_id' => 'required|uuid',
            'route_group_id' => 'required|uuid',
            'name' => 'required|string',
            'caller_id_number' => 'required|string',
            'audio_file_path' => 'required|string',
            'targets' => 'required|array|min:1',
            'targets.*' => 'required|string',
        ]);

        $campaign = VoiceBroadcastCampaign::create([
            'account_id' => $v['account_id'],
            'route_group_id' => $v['route_group_id'],
            'name' => $v['name'],
            'caller_id_number' => $v['caller_id_number'],
            'audio_file_path' => $v['audio_file_path'],
            'status' => 'draft',
        ]);

        foreach ($v['targets'] as $number) {
            VoiceBroadcastTarget::create([
                'campaign_id' => $campaign->id,
                'destination_number' => $number,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'success' => true,
            'campaign_id' => $campaign->id,
        ], 201);
    }

    public function startCampaign(string $id, VoiceBroadcastService $service): JsonResponse
    {
        $campaign = VoiceBroadcastCampaign::findOrFail($id);
        $service->processCampaign($campaign);

        return response()->json([
            'success' => true,
            'message' => 'Campaign started',
        ]);
    }
}
