<?php

namespace App\Filament\Resources\FusionPBX\UserSettings\Pages;

use App\Filament\Resources\FusionPBX\UserSettings\UserSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserSettings extends ListRecords
{
    protected static string $resource = UserSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
