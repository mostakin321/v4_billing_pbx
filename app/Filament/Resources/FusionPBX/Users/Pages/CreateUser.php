<?php

namespace App\Filament\Resources\FusionPBX\Users\Pages;

use App\Filament\Resources\FusionPBX\Users\Concerns\SyncsUserRelations;
use App\Filament\Resources\FusionPBX\Users\UserResource;
use App\Services\Identity\FusionUserAccountSyncService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateUser extends CreateRecord
{
    use SyncsUserRelations;

    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
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
            Log::warning('Account sync failed after user create', [
                'user_uuid' => $userUuid,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
