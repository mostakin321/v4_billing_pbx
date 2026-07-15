<?php

namespace App\Services\Billing;

use App\Models\Billing\Account;
use App\Services\Cgrates\Rpc\CgratesClient;
use Illuminate\Support\Facades\Log;

class CGRatesService
{
    public function __construct(
        protected CgratesClient $client = new CgratesClient(),
    ) {
        $this->client = new CgratesClient(
            endpoint: config('cgrates.url', 'http://127.0.0.1:2080/jsonrpc'),
            timeout: config('cgrates.timeout', 5),
        );
    }

    /**
     * Confirms CGRateS is reachable and responding.
     */
    public function ping(): bool
    {
        try {
            $result = $this->client->call('CoreSv1.Ping', []);
            return $result === 'Pong' || $result === true;
        } catch (\Throwable $e) {
            Log::warning('CGRateS ping failed', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public function syncAccount(Account $account): bool
    {
        $tenant = config('cgrates.tenant', 'cgrates.org');

        try {
            $this->client->setMonetaryBalance(
                $tenant,
                (string) $account->number,
                (float) $account->balance,
                (string) config('cgrates.balance_id', '1'),
            );
            return true;
        } catch (\Throwable $e) {
            Log::error('CGRateS account sync failed', [
                'account_id' => $account->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    public function getBalance(Account $account): ?float
    {
        $tenant = config('cgrates.tenant', 'cgrates.org');

        try {
            return $this->client->getMonetaryBalance(
                $tenant,
                (string) $account->number,
                (string) config('cgrates.balance_id', '1'),
            );
        } catch (\Throwable $e) {
            Log::warning('CGRateS balance fetch failed', [
                'account_id' => $account->id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    public function pullBalanceToAstpp(Account $account): ?float
    {
        $balance = $this->getBalance($account);

        if ($balance === null) {
            return null;
        }

        $account->forceFill([
            'balance' => $balance,
        ])->saveQuietly();

        return $balance;
    }

    public function removeAccount(Account $account): bool
    {
        $tenant = config('cgrates.tenant', 'cgrates.org');

        try {
            $this->client->call('APIerSv2.RemoveAccount', [
                'Tenant' => $tenant,
                'Account' => (string) $account->number,
            ]);
            return true;
        } catch (\Throwable $e) {
            Log::error('CGRateS account removal failed', [
                'account_id' => $account->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
