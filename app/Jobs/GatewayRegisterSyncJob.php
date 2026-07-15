<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GatewayRegisterSyncJob implements ShouldQueue
{
    use Queueable;

    public string $gatewayName;
    public string $profileName;

    /**
     * Create a new job instance.
     */
    public function __construct(string $gatewayName, string $profileName)
    {
        $this->gatewayName = $gatewayName;
        $this->profileName = $profileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO: Replace this with your ESL implementation.
        \Log::info('Gateway resync job started', [
            'gateway' => $this->gatewayName,
            'profile' => $this->profileName,
        ]);

        // Example placeholder:
        // Connect to FreeSWITCH ESL
        // Send:
        // sofia profile {$this->profileName} killgw {$this->gatewayName}
        // sleep(1);
        // sofia profile {$this->profileName} rescan reloadxml;
    }
}
