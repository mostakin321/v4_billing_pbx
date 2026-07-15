<?php

namespace App\Services\Cgrates\Accounting;

use App\Models\Billing\Account;
use App\Models\Cgrates\BillingTransaction;
use App\Services\Billing\CGRatesService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use RuntimeException;
use Throwable;

class BalanceSyncService
{
    public function __construct(
        protected CGRatesService $cgrates,
    ) {
    }

    public function topUp(
        Account $account,
        float $amount,
        string $referenceId,
        ?string $description = null,
    ): BillingTransaction {
        if ($amount <= 0) {
            throw new InvalidArgumentException(
                'Top-up amount must be greater than zero.'
            );
        }

        return $this->adjust(
            account: $account,
            delta: round($amount, 6),
            type: 'topup',
            referenceType: 'manual_topup',
            referenceId: $referenceId,
            description: $description ?? 'Manual account top-up',
        );
    }

    public function deduct(
        Account $account,
        float $amount,
        string $referenceId,
        ?string $description = null,
    ): BillingTransaction {
        if ($amount <= 0) {
            throw new InvalidArgumentException(
                'Deduction amount must be greater than zero.'
            );
        }

        return $this->adjust(
            account: $account,
            delta: -round($amount, 6),
            type: 'debit',
            referenceType: 'manual_deduction',
            referenceId: $referenceId,
            description: $description ?? 'Manual account deduction',
        );
    }

    public function reconcile(Account $account): float
    {
        $remoteBalance = $this->cgrates->getBalance($account);

        if ($remoteBalance === null) {
            throw new RuntimeException(
                'Unable to read the CGRateS balance.'
            );
        }

        DB::connection('astpp')->transaction(function () use (
            $account,
            $remoteBalance
        ): void {
            $lockedAccount = $account->newQuery()
                ->whereKey($account->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $lockedAccount->forceFill([
                'balance' => round($remoteBalance, 6),
            ])->saveQuietly();
        });

        return round($remoteBalance, 6);
    }

    protected function adjust(
        Account $account,
        float $delta,
        string $type,
        string $referenceType,
        string $referenceId,
        string $description,
    ): BillingTransaction {
        $referenceId = trim($referenceId);

        if ($referenceId === '') {
            throw new InvalidArgumentException(
                'A transaction reference is required.'
            );
        }

        return DB::connection('astpp')->transaction(function () use (
            $account,
            $delta,
            $type,
            $referenceType,
            $referenceId,
            $description,
        ): BillingTransaction {
            $lockedAccount = $account->newQuery()
                ->whereKey($account->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $existing = BillingTransaction::query()
                ->where('account_id', $lockedAccount->getKey())
                ->where('reference_type', $referenceType)
                ->where('reference_id', $referenceId)
                ->first();

            if ($existing) {
                return $existing;
            }

            $balanceBefore = $this->cgrates->getBalance($lockedAccount);

            if ($balanceBefore === null) {
                throw new RuntimeException(
                    'Unable to read the current CGRateS balance.'
                );
            }

            $balanceBefore = round($balanceBefore, 6);
            $balanceAfter = round($balanceBefore + $delta, 6);

            if ($balanceAfter < 0) {
                throw new RuntimeException('Insufficient balance.');
            }

            if (! $this->cgrates->setBalance(
                $lockedAccount,
                $balanceAfter,
            )) {
                throw new RuntimeException(
                    'CGRateS rejected the balance update.'
                );
            }

            try {
                $lockedAccount->forceFill([
                    'balance' => $balanceAfter,
                ])->saveQuietly();

                return BillingTransaction::create([
                    'account_id' => $lockedAccount->getKey(),
                    'cdr_id' => null,
                    'type' => $type,
                    'amount' => $delta,
                    'balance_before' => $balanceBefore,
                    'balance_after' => $balanceAfter,
                    'description' => $description,
                    'reference_type' => $referenceType,
                    'reference_id' => $referenceId,
                ]);
            } catch (Throwable $e) {
                try {
                    $this->cgrates->setBalance(
                        $lockedAccount,
                        $balanceBefore,
                    );
                } catch (Throwable $rollbackError) {
                    Log::critical(
                        'CGRateS balance compensation failed',
                        [
                            'account_id' => $lockedAccount->getKey(),
                            'account_number' => $lockedAccount->number,
                            'expected_balance' => $balanceBefore,
                            'error' => $rollbackError->getMessage(),
                        ],
                    );
                }

                throw $e;
            }
        });
    }

    public function recordLedger(
        string $accountId,
        string $type,
        float $amount,
        float $balanceAfter,
        ?string $referenceId = null,
        ?string $description = null,
    ): BillingTransaction {
        return BillingTransaction::create([
            'account_id' => $accountId,
            'type' => $type,
            'amount' => $amount,
            'balance_before' => null,
            'balance_after' => $balanceAfter,
            'reference_type' => 'legacy',
            'reference_id' => $referenceId,
            'description' => $description,
        ]);
    }
}
