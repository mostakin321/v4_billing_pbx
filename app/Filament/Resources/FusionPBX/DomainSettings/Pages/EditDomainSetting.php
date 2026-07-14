<?php

namespace App\Filament\Resources\FusionPBX\DomainSettings\Pages;

use App\Filament\Resources\FusionPBX\DomainSettings\DomainSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDomainSetting extends EditRecord
{
    protected static string $resource = DomainSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
