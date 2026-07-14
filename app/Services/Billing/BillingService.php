<?php
namespace App\Services\Billing;

use App\Models\Billing\Account;
use App\Models\Billing\BillingTransaction;
use Illuminate\Support\Facades\DB;

class BillingService
{
    public function credit(Account $account, float $amount, string $description = '', string $type = 'topup'): void
    {
        DB::transaction(function () use ($account, $amount, $description, $type) {
            $before = (float) $account->balance;
            $after  = $before + $amount;

            $account->update(['balance' => $after]);

            BillingTransaction::create([
                'account_id'     => $account->id,
                'type'           => $type,
                'amount'         => $amount,
                'balance_before' => $before,
                'balance_after'  => $after,
                'description'    => $description ?: 'Manual credit',
                'reference_type' => $type,
                'created_at'     => now(),
            ]);
        });
    }

    public function debit(Account $account, float $amount, string $type = 'charge', string $description = ''): void
    {
        DB::transaction(function () use ($account, $amount, $type, $description) {
            $before = (float) $account->balance;
            $after  = $before - $amount;

            $account->update(['balance' => $after]);

            BillingTransaction::create([
                'account_id'     => $account->id,
                'type'           => $type,
                'amount'         => -$amount,
                'balance_before' => $before,
                'balance_after'  => $after,
                'description'    => $description ?: 'Manual debit',
                'reference_type' => $type,
                'created_at'     => now(),
            ]);
        });
    }
}
