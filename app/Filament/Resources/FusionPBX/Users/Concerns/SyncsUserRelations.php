<?php

namespace App\Filament\Resources\FusionPBX\Users\Concerns;

use App\Models\FusionPBX\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait SyncsUserRelations
{
    /**
     * Persist Language / Time Zone (v_user_settings) and Groups
     * (v_user_groups) for the given user, using values captured
     * from the form's dehydrated(false) fields via $this->data.
     */
    protected function syncUserRelations(User $user): void
    {
        $language = $this->data['user_language'] ?? null;
        $timeZone = $this->data['user_time_zone'] ?? null;
        $groupUuids = $this->data['groups'] ?? [];

        try {
            $this->syncSetting($user, 'language', 'code', $language);
            $this->syncSetting($user, 'time_zone', 'name', $timeZone);
            $this->syncGroups($user, $groupUuids);
        } catch (\Throwable $e) {
            Log::warning('User relation sync failed', [
                'user_uuid' => $user->user_uuid,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function syncSetting(User $user, string $subcategory, string $name, ?string $value): void
    {
        $existing = DB::connection('fusion')
            ->table('v_user_settings')
            ->where('user_uuid', $user->user_uuid)
            ->where('user_setting_category', 'domain')
            ->where('user_setting_subcategory', $subcategory)
            ->first();

        if (empty($value)) {
            if ($existing) {
                DB::connection('fusion')
                    ->table('v_user_settings')
                    ->where('user_setting_uuid', $existing->user_setting_uuid)
                    ->delete();
            }
            return;
        }

        if ($existing) {
            DB::connection('fusion')
                ->table('v_user_settings')
                ->where('user_setting_uuid', $existing->user_setting_uuid)
                ->update([
                    'user_setting_value' => $value,
                    'update_date' => now(),
                ]);
        } else {
            DB::connection('fusion')
                ->table('v_user_settings')
                ->insert([
                    'user_setting_uuid' => (string) \Illuminate\Support\Str::uuid(),
                    'user_uuid' => $user->user_uuid,
                    'domain_uuid' => $user->domain_uuid,
                    'user_setting_category' => 'domain',
                    'user_setting_subcategory' => $subcategory,
                    'user_setting_name' => $name,
                    'user_setting_value' => $value,
                    'user_setting_enabled' => true,
                    'insert_date' => now(),
                ]);
        }
    }

    private function syncGroups(User $user, array $groupUuids): void
    {
        $current = DB::connection('fusion')
            ->table('v_user_groups')
            ->where('user_uuid', $user->user_uuid)
            ->pluck('group_uuid')
            ->map(fn ($uuid) => (string) $uuid)
            ->all();

        $toAdd = array_diff($groupUuids, $current);
        $toRemove = array_diff($current, $groupUuids);

        if ($toRemove !== []) {
            DB::connection('fusion')
                ->table('v_user_groups')
                ->where('user_uuid', $user->user_uuid)
                ->whereIn('group_uuid', $toRemove)
                ->delete();
        }

        foreach ($toAdd as $groupUuid) {
            $groupName = DB::connection('fusion')
                ->table('v_groups')
                ->where('group_uuid', $groupUuid)
                ->value('group_name');

            DB::connection('fusion')
                ->table('v_user_groups')
                ->insert([
                    'user_group_uuid' => (string) \Illuminate\Support\Str::uuid(),
                    'user_uuid' => $user->user_uuid,
                    'domain_uuid' => $user->domain_uuid,
                    'group_uuid' => $groupUuid,
                    'group_name' => $groupName,
                    'insert_date' => now(),
                ]);
        }
    }
}
