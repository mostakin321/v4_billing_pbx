<?php

namespace App\Filament\Resources\FusionPBX\MenuItemGroups\Pages;

use App\Filament\Resources\FusionPBX\MenuItemGroups\MenuItemGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuItemGroups extends ListRecords
{
    protected static string $resource = MenuItemGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
