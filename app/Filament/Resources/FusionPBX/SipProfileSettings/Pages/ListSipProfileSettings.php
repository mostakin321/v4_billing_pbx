<?php

namespace App\Filament\Resources\FusionPBX\SipProfileSettings\Pages;

use App\Filament\Resources\FusionPBX\SipProfileSettings\SipProfileSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSipProfileSettings extends ListRecords
{
    protected static string $resource = SipProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
