<?php

namespace App\Filament\Resources\FusionPBX\IvrMenuOptions\Pages;

use App\Filament\Resources\FusionPBX\IvrMenuOptions\IvrMenuOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIvrMenuOptions extends ListRecords
{
    protected static string $resource = IvrMenuOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
