<?php

namespace App\Filament\Resources\FusionPBX\SipProfileSettings\Pages;

use App\Filament\Resources\FusionPBX\SipProfileSettings\SipProfileSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSipProfileSetting extends EditRecord
{
    protected static string $resource = SipProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
