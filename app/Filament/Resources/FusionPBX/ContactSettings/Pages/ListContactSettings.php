<?php

namespace App\Filament\Resources\FusionPBX\ContactSettings\Pages;

use App\Filament\Resources\FusionPBX\ContactSettings\ContactSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactSettings extends ListRecords
{
    protected static string $resource = ContactSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
