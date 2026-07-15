<?php

namespace App\Filament\Resources\FusionPBX\Extensions\Pages;

use App\Filament\Resources\FusionPBX\Extensions\ExtensionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EditExtension extends EditRecord
{
    protected static string $resource = ExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $extensionUuid = $data['extension_uuid'] ?? null;

        if (empty($extensionUuid)) {
            return $data;
        }

        $data['users'] = DB::connection('fusion')
            ->table('v_extension_users')
            ->where('extension_uuid', $extensionUuid)
            ->pluck('user_uuid')
            ->map(fn ($uuid) => (string) $uuid)
            ->all();

        return $data;
    }

    protected function afterSave(): void
    {
        $extensionUuid = $this->record->extension_uuid;
        $selectedUuids = $this->data['users'] ?? [];

        $current = DB::connection('fusion')
            ->table('v_extension_users')
            ->where('extension_uuid', $extensionUuid)
            ->pluck('user_uuid')
            ->map(fn ($uuid) => (string) $uuid)
            ->all();

        $toAdd = array_diff($selectedUuids, $current);
        $toRemove = array_diff($current, $selectedUuids);

        if ($toRemove !== []) {
            DB::connection('fusion')
                ->table('v_extension_users')
                ->where('extension_uuid', $extensionUuid)
                ->whereIn('user_uuid', $toRemove)
                ->delete();
        }

        foreach ($toAdd as $userUuid) {
            DB::connection('fusion')->table('v_extension_users')->insert([
                'extension_user_uuid' => (string) Str::uuid(),
                'domain_uuid' => $this->record->domain_uuid,
                'extension_uuid' => $extensionUuid,
                'user_uuid' => $userUuid,
                'insert_date' => now(),
            ]);
        }
    }
}
