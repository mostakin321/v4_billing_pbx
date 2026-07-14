<?php

namespace App\Filament\Resources\FusionPBX\ExtensionSettings\Pages;

use App\Filament\Resources\FusionPBX\ExtensionSettings\ExtensionSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExtensionSettings extends ListRecords
{
    protected static string $resource = ExtensionSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
