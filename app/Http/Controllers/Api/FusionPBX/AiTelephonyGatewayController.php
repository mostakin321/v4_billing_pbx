<?php

namespace App\Http\Controllers\Api\FusionPBX;

use App\Http\Controllers\Controller;
use App\Models\TelephonyAiAgent;
use App\Models\TelephonyAiTranscript;
use App\Services\AI\LlmAdapterFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiTelephonyGatewayController extends Controller
{
    public function interact(Request $request, LlmAdapterFactory $factory): JsonResponse
    {
        $v = $request->validate([
            'ai_agent_id' => 'required|uuid',
            'xml_cdr_uuid' => 'nullable|uuid',
            'user_speech_input' => 'required|string',
            'session_history' => 'nullable|array',
        ]);

        $agent = TelephonyAiAgent::where('is_active', true)->findOrFail($v['ai_agent_id']);
        $driver = $factory->build($agent->provider_engine);

        $transcript = TelephonyAiTranscript::firstOrNew([
            'ai_agent_id' => $agent->id,
            'xml_cdr_uuid' => $v['xml_cdr_uuid'] ?? null,
        ]);

        $history = $transcript->conversation_history ?: ($v['session_history'] ?? []);

        $result = $driver->generateResponse(
            $agent->system_prompt,
            $v['user_speech_input'],
            $history,
            $agent->model
        );

        $reply = $result['reply_text'] ?? 'Please hold while I connect you.';
        $action = $result['action'] ?? 'continue';
        $target = $result['target'] ?? null;

        if ($action === 'transfer_queue' && ! $target && $agent->fallback_queue) {
            $target = $agent->fallback_queue;
        }

        $history[] = ['role' => 'user', 'content' => $v['user_speech_input']];
        $history[] = ['role' => 'assistant', 'content' => $reply];

        $transcript->fill([
            'conversation_history' => $history,
            'last_action' => $action,
            'handoff_target' => $target,
        ])->save();

        return response()->json([
            'success' => true,
            'mode' => in_array($action, ['transfer_queue','transfer_extension']) ? 'human_handoff' : 'ai_self_service',
            'provider_used' => $agent->provider_engine,
            'reply_text' => $reply,
            'next_action' => $action,
            'target' => $target,
            'dial_execute_str' => match ($action) {
                'transfer_queue' => "callcenter/{$target}",
                'transfer_extension' => "user/{$target}",
                'hangup' => 'hangup',
                default => 'continue',
            },
        ]);
    }
}
