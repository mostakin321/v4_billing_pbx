<?php

namespace App\Jobs;

use App\Models\Account;
use App\Services\Identity\FusionUserAccountSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncAccountToFusionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 30;
    public int $backoff = 5;

    public function __construct(public string $accountId)
    {
        $this->onQueue('default');
    }

    public function handle(FusionUserAccountSyncService $fusionSync): void
    {
        $account = Account::find($this->accountId);

        if (!$account || empty($account->user_uuid)) {
            return;
        }

        try {
            $fusionSync->pushAccountToFusion($account, [
                'username'     => $account->username,
                'email'        => $account->email,
                'status'       => $account->status,
                'account_type' => $account->account_type,
            ]);

            Log::info('Account identity synced to FusionPBX (queued)', [
                'account_id' => $account->id,
                'user_uuid'  => $account->user_uuid,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Account -> FusionPBX sync failed (queued)', [
                'account_id' => $account->id,
                'error'      => $e->getMessage(),
            ]);
        }
    }
}
