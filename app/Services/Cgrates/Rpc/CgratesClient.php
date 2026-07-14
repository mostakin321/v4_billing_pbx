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

    public function getAccountBalance(string $tenant, string $account): array
    {
        return $this->call('APIerSv2.GetAccount', [
            'Tenant' => $tenant,
            'Account' => $account,
        ]);
    }

    public function setAccountBalance(string $tenant, string $account, float $balance): bool
    {
        $this->call('APIerSv2.SetAccount', [
            'Tenant' => $tenant,
            'Account' => $account,
            'BalanceMap' => ['*default' => [['Value' => $balance]]],
        ]);
        return true;
    }
}
