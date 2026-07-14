<?php

namespace App\Services\Cgrates\Accounting;

use App\DTO\AccountActionData;
use App\Models\Cgrates\TpAccountAction;

class AccountActionProvisioner
{
    public function upsert(AccountActionData $data, string $tpid = 'default', string $loadid = 'laravel'): TpAccountAction
    {
        return TpAccountAction::updateOrCreate(
            [
                'tpid' => $tpid,
                'loadid' => $loadid,
                'tenant' => $data->tenant,
                'account' => $data->account,
            ],
            [
                'action_plan_tag' => $data->actionPlanTag,
                'action_triggers_tag' => $data->actionTriggersTag,
                'allow_negative' => (bool) $data->allowNegative,
                'disabled' => (bool) $data->disabled,
            ]
        );
    }
}
