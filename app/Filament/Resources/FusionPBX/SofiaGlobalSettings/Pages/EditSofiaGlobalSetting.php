<?php

namespace App\Filament\Resources\FusionPBX\SofiaGlobalSettings\Pages;

use App\Filament\Resources\FusionPBX\SofiaGlobalSettings\SofiaGlobalSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSofiaGlobalSetting extends EditRecord
{
    protected static string $resource = SofiaGlobalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
