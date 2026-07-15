<?php

namespace App\Filament\Resources\FusionPBX\Extensions\Pages;

use App\Filament\Resources\FusionPBX\Extensions\ExtensionResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateExtension extends CreateRecord
{
    protected static string $resource = ExtensionResource::class;

    protected function afterCreate(): void
    {
        $userUuids = $this->data['users'] ?? [];

        if (empty($userUuids)) {
            return;
        }

        foreach ($userUuids as $userUuid) {
            DB::connection('fusion')->table('v_extension_users')->insert([
                'extension_user_uuid' => (string) Str::uuid(),
                'domain_uuid' => $this->record->domain_uuid,
                'extension_uuid' => $this->record->extension_uuid,
                'user_uuid' => $userUuid,
                'insert_date' => now(),
            ]);
        }
    }
}
