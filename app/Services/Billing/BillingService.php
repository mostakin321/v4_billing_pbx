<?php

namespace App\Services\Billing;

use App\Models\Astpp\Account as AstppAccount;
use App\Models\Billing\Account as BillingAccount;
use App\Services\Cgrates\Accounting\BalanceSyncService;
use Illuminate\Support\Str;
use InvalidArgumentException;
use RuntimeException;

class BillingService
{
    public function __construct(
        protected BalanceSyncService $balanceSync,
    ) {
    }

    /**
     * Credit the ASTPP and CGRateS balances together.
     *
     * A pricelist or rating profile is not required for top-up.
     */
    public function credit(
        AstppAccount $account,
        float $amount,
        string $description = '',
        string $type = 'topup',
    ): void {
        if ($amount <= 0) {
            throw new InvalidArgumentException(
                'Top-up amount must be greater than zero.'
            );
        }

        $billingAccount = $this->resolveBillingAccount($account);

        $this->balanceSync->topUp(
            $billingAccount,
            $amount,
            'FILAMENT-TOPUP-'.Str::uuid(),
            $description !== ''
                ? $description
                : 'Manual top-up via Filament',
        );

        $account->refresh();
    }

    /**
     * Deduct from the ASTPP and CGRateS balances together.
     *
     * A pricelist is not required, but sufficient balance is required.
     */
    public function debit(
        AstppAccount $account,
        float $amount,
        string $type = 'charge',
        string $description = '',
    ): void {
        if ($amount <= 0) {
            throw new InvalidArgumentException(
                'Deduction amount must be greater than zero.'
            );
        }

        $billingAccount = $this->resolveBillingAccount($account);

        $currentBalance = (float) $billingAccount->balance;

        if ($amount > $currentBalance) {
            throw new RuntimeException(
                sprintf(
                    'Insufficient balance. Available: %.5f, requested: %.5f.',
                    $currentBalance,
                    $amount,
                )
            );
        }

        $this->balanceSync->deduct(
            $billingAccount,
            $amount,
            'FILAMENT-DEDUCT-'.Str::uuid(),
            $description !== ''
                ? $description
                : 'Manual deduction via Filament',
        );

        $account->refresh();
    }

    protected function resolveBillingAccount(
        AstppAccount $account,
    ): BillingAccount {
        $billingAccount = BillingAccount::query()
            ->whereKey($account->getKey())
            ->first();

        if (! $billingAccount) {
            throw new RuntimeException(
                "Billing account {$account->number} could not be loaded."
            );
        }

        return $billingAccount;
    }
}
