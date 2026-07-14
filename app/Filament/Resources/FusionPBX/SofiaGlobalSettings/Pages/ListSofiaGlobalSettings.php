<?php

namespace App\Filament\Resources\FusionPBX\SofiaGlobalSettings\Pages;

use App\Filament\Resources\FusionPBX\SofiaGlobalSettings\SofiaGlobalSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSofiaGlobalSettings extends ListRecords
{
    protected static string $resource = SofiaGlobalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
