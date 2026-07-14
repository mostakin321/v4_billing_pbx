<?php

namespace App\Services\Cgrates\Accounting;

use App\Models\Cgrates\BillingTransaction;

class BalanceSyncService
{
    public function recordLedger(string $accountId, string $type, float $amount, float $balanceAfter, ?string $referenceId = null, ?string $description = null): BillingTransaction
    {
        return BillingTransaction::create([
            'account_id' => $accountId,
            'type' => $type,
            'amount' => $amount,
            'balance_after' => $balanceAfter,
            'reference_id' => $referenceId,
            'description' => $description,
        ]);
    }
}
