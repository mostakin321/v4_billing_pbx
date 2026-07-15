<?php

namespace App\Services\Cgrates\Rpc;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class CgratesClient
{
    public function __construct(
        protected string $endpoint = 'http://127.0.0.1:2080/jsonrpc',
        protected int $timeout = 10,
    ) {}

    public function call(string $method, array $params = []): mixed
    {
        try {
            $response = Http::timeout($this->timeout)
                ->post($this->endpoint, [
                    'jsonrpc' => '2.0',
                    'method' => $method,
                    'params' => $params,
                    'id' => uniqid(),
                ]);

            if ($response->failed()) {
                throw new RuntimeException("CGRateS RPC call failed: {$response->status()}");
            }

            $data = $response->json();
            
            if (isset($data['error'])) {
                throw new RuntimeException("CGRateS Error: " . json_encode($data['error']));
            }

            return $data['result'] ?? $data;
        } catch (\Exception $e) {
            throw new RuntimeException("CGRateS RPC error: " . $e->getMessage());
        }
    }

    public function reload(string $tenant = '*'): bool
    {
        $result = $this->call('APIerSv1.ReloadConfig', ['Tenant' => $tenant]);
        return true;
    }

    public function getAccounts(
        string $tenant,
        array $accountIds = [],
    ): array {
        $result = $this->call('ApierV1.GetAccounts', [[
            'Tenant' => $tenant,
            'AccountIds' => array_values($accountIds),
        ]]);

        return is_array($result) ? $result : [];
    }

    public function getAccount(
        string $tenant,
        string $account,
    ): ?array {
        $accounts = $this->getAccounts($tenant, [$account]);

        foreach ($accounts as $item) {
            if (! is_array($item)) {
                continue;
            }

            $id = (string) ($item['Id'] ?? $item['ID'] ?? '');

            if (
                $id === $account ||
                str_ends_with($id, ':'.$account)
            ) {
                return $item;
            }
        }

        return null;
    }

    public function getMonetaryBalance(
        string $tenant,
        string $account,
        string $balanceId = '1',
    ): ?float {
        $accountData = $this->getAccount($tenant, $account);

        if (! $accountData) {
            return null;
        }

        $balanceMap = $accountData['BalanceMap'] ?? [];

        $balances =
            $balanceMap['*monetary*out']
            ?? $balanceMap['*monetary']
            ?? [];

        if (! is_array($balances)) {
            return null;
        }

        foreach ($balances as $balance) {
            if (! is_array($balance)) {
                continue;
            }

            $id = (string) (
                $balance['Id']
                ?? $balance['ID']
                ?? ''
            );

            $disabled = (bool) (
                $balance['Disabled']
                ?? false
            );

            if ($id === $balanceId && ! $disabled) {
                return (float) ($balance['Value'] ?? 0);
            }
        }

        return null;
    }

    public function setMonetaryBalance(
        string $tenant,
        string $account,
        float $value,
        string $balanceId = '1',
    ): bool {
        $result = $this->call('ApierV1.SetBalance', [[
            'Tenant' => $tenant,
            'Account' => $account,
            'BalanceType' => '*monetary',
            'Action' => '*set',
            'Value' => round($value, 6),
            'Balance' => [
                'ID' => $balanceId,
            ],
        ]]);

        return $result === 'OK' || $result === true;
    }
}
