<?php

namespace App\Filament\Resources\FusionPBX\ExtensionSettings\Pages;

use App\Filament\Resources\FusionPBX\ExtensionSettings\ExtensionSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExtensionSetting extends EditRecord
{
    protected static string $resource = ExtensionSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
