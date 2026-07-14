<?php

namespace App\Filament\Resources\FusionPBX\ContactSettings\Pages;

use App\Filament\Resources\FusionPBX\ContactSettings\ContactSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactSetting extends EditRecord
{
    protected static string $resource = ContactSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
