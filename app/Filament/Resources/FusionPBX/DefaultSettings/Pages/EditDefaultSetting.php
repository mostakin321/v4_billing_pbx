<?php

namespace App\Filament\Resources\FusionPBX\DefaultSettings\Pages;

use App\Filament\Resources\FusionPBX\DefaultSettings\DefaultSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDefaultSetting extends EditRecord
{
    protected static string $resource = DefaultSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
