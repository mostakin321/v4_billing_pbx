<?php

namespace App\Filament\Resources\FusionPBX\DomainSettings\Pages;

use App\Filament\Resources\FusionPBX\DomainSettings\DomainSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDomainSettings extends ListRecords
{
    protected static string $resource = DomainSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
