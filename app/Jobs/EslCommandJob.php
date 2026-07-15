<?php
namespace App\Jobs;

use App\Services\FreeSwitchEsl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EslCommandJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries   = 3;
    public int $timeout = 30;

    public function __construct(
        private readonly string $command,
        private readonly string $label = '',
    ) {
        $this->onQueue(config('freeswitch.queues.events', 'freeswitch-events'));
    }

    public function handle(): void
    {
        $result = FreeSwitchEsl::run($this->command);
        $label  = $this->label ?: $this->command;
        if ($result['ok']) {
            Log::info("EslCommandJob [{$label}]: ".$result['output']);
        } else {
            Log::error("EslCommandJob [{$label}] failed: ".$result['error']);
            $this->fail(new \RuntimeException($result['error'] ?? 'ESL error'));
        }
    }
}
