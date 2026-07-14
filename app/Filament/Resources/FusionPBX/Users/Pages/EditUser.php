<?php

namespace App\Filament\Resources\FusionPBX\Users\Pages;

use App\Filament\Resources\FusionPBX\Users\Concerns\SyncsUserRelations;
use App\Filament\Resources\FusionPBX\Users\UserResource;
use App\Services\Identity\FusionUserAccountSyncService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditUser extends EditRecord
{
    use SyncsUserRelations;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /**
     * Populate the dehydrated(false) fields (language, time_zone, groups)
     * from their separate tables when the edit form loads.
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $userUuid = $data['user_uuid'] ?? null;

        if (empty($userUuid)) {
            return $data;
        }

        $language = DB::connection('fusion')
            ->table('v_user_settings')
            ->where('user_uuid', $userUuid)
            ->where('user_setting_subcategory', 'language')
            ->value('user_setting_value');

        $timeZone = DB::connection('fusion')
            ->table('v_user_settings')
            ->where('user_uuid', $userUuid)
            ->where('user_setting_subcategory', 'time_zone')
            ->value('user_setting_value');

        $groups = DB::connection('fusion')
            ->table('v_user_groups')
            ->where('user_uuid', $userUuid)
            ->pluck('group_uuid')
            ->map(fn ($uuid) => (string) $uuid)
            ->all();

        $data['user_language'] = $language;
        $data['user_time_zone'] = $timeZone;
        $data['groups'] = $groups;

        return $data;
    }

    protected function afterSave(): void
    {
        $this->syncUserRelations($this->record);

        $userUuid = $this->record->user_uuid ?? null;

        if (empty($userUuid)) {
            return;
        }

        try {
            app(FusionUserAccountSyncService::class)
                ->importFusionUser($userUuid);
        } catch (\Throwable $e) {
            Log::warning('Account sync failed after user update', [
                'user_uuid' => $userUuid,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
