<?php

namespace App\Filament\Resources\FusionPBX\IvrMenus\Pages;

use App\Filament\Resources\FusionPBX\IvrMenus\IvrMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIvrMenus extends ListRecords
{
    protected static string $resource = IvrMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
