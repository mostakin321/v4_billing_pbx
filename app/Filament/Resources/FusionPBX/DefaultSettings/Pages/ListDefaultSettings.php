<?php

namespace App\Filament\Resources\FusionPBX\DefaultSettings\Pages;

use App\Filament\Resources\FusionPBX\DefaultSettings\DefaultSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDefaultSettings extends ListRecords
{
    protected static string $resource = DefaultSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
