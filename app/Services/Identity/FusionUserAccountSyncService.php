<?php

namespace App\Services\Identity;

use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class FusionUserAccountSyncService
{
    /**
     * Import one FusionPBX v_user into the Kazitel accounts table.
     *
     * FusionPBX owns:
     * - user_uuid
     * - domain_uuid
     * - username
     * - user_email
     * - user_enabled
     *
     * Kazitel owns:
     * - account_type
     * - billing/provider/reseller flags
     * - balance
     * - route group
     * - package and business configuration
     */
    public function importFusionUser(string $userUuid): Account
    {
        $fusionUser = DB::connection('fusion')
            ->table('v_users')
            ->where('user_uuid', $userUuid)
            ->first();

        if (! $fusionUser) {
            throw new RuntimeException(
                "FusionPBX user {$userUuid} was not found."
            );
        }

        $account = Account::query()
            ->where('user_uuid', $userUuid)
            ->first();

        $accountType = $account?->account_type
            ?: ($fusionUser->username === 'admin'
                ? 'admin'
                : 'customer');

        $values = [
            'domain_uuid' => $fusionUser->domain_uuid,
            'username' => $fusionUser->username,
            'email' => $fusionUser->user_email,
            'company_name' => $account?->company_name
                ?: $fusionUser->username,
            'account_type' => $accountType,
            'billing_enabled' => $account?->billing_enabled ?? true,
            'provider_enabled' => in_array(
                $accountType,
                ['provider', 'carrier'],
                true
            ),
            'reseller_enabled' => $accountType === 'reseller',
            'crm_enabled' => $account?->crm_enabled ?? false,
            'ai_enabled' => $account?->ai_enabled ?? false,
            'status' => $this->enabled(
                $fusionUser->user_enabled
            ) ? 'active' : 'inactive',
        ];

        /*
         * When creating a new account, populate existing billing-core
         * fields only when those columns exist.
         */
        if (! $account) {
            if (Schema::hasColumn('accounts', 'cgrates_account_id')) {
                $values['cgrates_account_id'] =
                    'fusion:' . $fusionUser->user_uuid;
            }

            if (Schema::hasColumn('accounts', 'billing_type')) {
                $values['billing_type'] = 'prepaid';
            }

            if (Schema::hasColumn('accounts', 'balance')) {
                $values['balance'] = 0;
            }

            if (Schema::hasColumn('accounts', 'credit_limit')) {
                $values['credit_limit'] = 0;
            }
        }

        return Account::query()->updateOrCreate(
            ['user_uuid' => $userUuid],
            $values
        );
    }

    /**
     * Import all FusionPBX users.
     */
    public function importAll(): array
    {
        $userUuids = DB::connection('fusion')
            ->table('v_users')
            ->pluck('user_uuid');

        $synced = 0;
        $failed = 0;

        foreach ($userUuids as $userUuid) {
            try {
                $this->importFusionUser((string) $userUuid);
                $synced++;
            } catch (\Throwable $exception) {
                $failed++;

                Log::error('FusionPBX user account synchronization failed', [
                    'user_uuid' => $userUuid,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        return [
            'synced' => $synced,
            'failed' => $failed,
        ];
    }

    /**
     * Push editable identity fields from Kazitel to FusionPBX.
     *
     * Account type and business flags remain in Kazitel only.
     */
    public function pushAccountToFusion(
        Account $account,
        array $data
    ): Account {
        if (! $account->user_uuid) {
            throw new RuntimeException(
                'This account is not linked to a FusionPBX user.'
            );
        }

        $exists = DB::connection('fusion')
            ->table('v_users')
            ->where('user_uuid', $account->user_uuid)
            ->exists();

        if (! $exists) {
            throw new RuntimeException(
                'The linked FusionPBX user no longer exists.'
            );
        }

        $fusionValues = [];

        if (array_key_exists('username', $data)) {
            $fusionValues['username'] = $data['username'];
        }

        if (array_key_exists('email', $data)) {
            $fusionValues['user_email'] = $data['email'];
        }

        if (array_key_exists('status', $data)) {
            $fusionValues['user_enabled'] =
                $data['status'] === 'active' ? '1' : '0';
        }

        if ($fusionValues !== []) {
            if (
                Schema::connection('fusion')
                    ->hasColumn('v_users', 'update_date')
            ) {
                $fusionValues['update_date'] = now();
            }

            DB::connection('fusion')
                ->table('v_users')
                ->where('user_uuid', $account->user_uuid)
                ->update($fusionValues);
        }

        $accountType = $data['account_type']
            ?? $account->account_type
            ?? 'customer';

        $account->fill([
            'username' => $data['username']
                ?? $account->username,
            'email' => $data['email']
                ?? $account->email,
            'company_name' => $data['company_name']
                ?? $account->company_name,
            'account_type' => $accountType,
            'parent_account_id' => $data['parent_account_id']
                ?? $account->parent_account_id,
            'billing_enabled' => $data['billing_enabled']
                ?? $account->billing_enabled,
            'provider_enabled' => in_array(
                $accountType,
                ['provider', 'carrier'],
                true
            ),
            'reseller_enabled' =>
                $accountType === 'reseller',
            'crm_enabled' => $data['crm_enabled']
                ?? $account->crm_enabled,
            'ai_enabled' => $data['ai_enabled']
                ?? $account->ai_enabled,
            'status' => $data['status']
                ?? $account->status,
        ]);

        $account->save();

        return $this->importFusionUser($account->user_uuid);
    }

    private function enabled(mixed $value): bool
    {
        return in_array(
            strtolower((string) $value),
            ['1', 't', 'true', 'yes', 'enabled'],
            true
        );
    }
}
