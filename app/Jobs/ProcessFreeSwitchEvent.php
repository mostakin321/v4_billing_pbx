<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Receives and routes FreeSWITCH ESL events dispatched by FreeSwitchEventConsumer.
 */
class ProcessFreeSwitchEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $timeout = 30;

    public function __construct(private readonly array $event)
    {
        $this->onQueue(config('freeswitch.queues.events', 'freeswitch-events'));
    }

    public function handle(): void
    {
        $type = $this->event['Event-Name'] ?? 'UNKNOWN';

        Log::debug("FSEvent[{$type}] uuid=".($this->event['Unique-ID'] ?? ''));

        match ($type) {
            'CHANNEL_CREATE'          => $this->handleChannelCreate(),
            'CHANNEL_ANSWER'          => $this->handleChannelAnswer(),
            'CHANNEL_HANGUP_COMPLETE' => $this->handleHangup(),
            'CHANNEL_BRIDGE'          => $this->handleBridge(),
            'BACKGROUND_JOB'          => $this->handleBackgroundJob(),
            'CUSTOM'                  => $this->handleCustom(),
            'CALL_CENTER_MEMBER_QUEUE_START' => $this->handleCCMemberJoined(),
            'CALL_CENTER_AGENT_STATUS_CHANGE' => $this->handleCCAgentStatus(),
            default => null,
        };
    }

    private function handleChannelCreate(): void
    {
        $uuid  = $this->event['Unique-ID'] ?? '';
        $from  = $this->event['Caller-Caller-ID-Number'] ?? '';
        $dest  = $this->event['Caller-Destination-Number'] ?? '';

        // Track active calls in cache (for real-time dashboard)
        $calls = Cache::get('active_calls', []);
        $calls[$uuid] = [
            'uuid'      => $uuid,
            'from'      => $from,
            'dest'      => $dest,
            'state'     => 'ringing',
            'direction' => $this->event['Call-Direction'] ?? '',
            'created'   => now()->toIso8601String(),
        ];
        Cache::put('active_calls', $calls, now()->addHour());
    }

    private function handleChannelAnswer(): void
    {
        $uuid  = $this->event['Unique-ID'] ?? '';
        $calls = Cache::get('active_calls', []);
        if (isset($calls[$uuid])) {
            $calls[$uuid]['state']     = 'answered';
            $calls[$uuid]['answered']  = now()->toIso8601String();
            Cache::put('active_calls', $calls, now()->addHour());
        }
    }

    private function handleHangup(): void
    {
        $uuid = $this->event['Unique-ID'] ?? '';

        // Remove from active calls cache
        $calls = Cache::get('active_calls', []);
        unset($calls[$uuid]);
        Cache::put('active_calls', $calls, now()->addHour());

        // Process CDR (store + missed call notification)
        dispatch(new ProcessCdrEvent($this->event));
    }

    private function handleBridge(): void
    {
        $uuid  = $this->event['Unique-ID'] ?? '';
        $calls = Cache::get('active_calls', []);
        if (isset($calls[$uuid])) {
            $calls[$uuid]['state']   = 'bridged';
            $calls[$uuid]['b_uuid']  = $this->event['Bridge-B-Unique-ID'] ?? '';
            Cache::put('active_calls', $calls, now()->addHour());
        }
    }

    private function handleBackgroundJob(): void
    {
        // Background jobs can include voicemail notifications, etc.
        $subclass = $this->event['Event-Subclass'] ?? '';
        Log::debug("BGAPI result: {$subclass}");
    }

    private function handleCustom(): void
    {
        $subclass = $this->event['Event-Subclass'] ?? '';

        // Call center agent events
        if (str_contains($subclass, 'callcenter')) {
            dispatch(new SyncCallCenterStatus());
        }
    }

    private function handleCCMemberJoined(): void
    {
        dispatch(new SyncCallCenterStatus());
    }

    private function handleCCAgentStatus(): void
    {
        dispatch(new SyncCallCenterStatus());
    }
}
