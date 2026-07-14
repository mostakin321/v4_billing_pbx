<?php

namespace App\Filament\Resources\FusionPBX\Menus\Pages;

use App\Filament\Resources\FusionPBX\Menus\MenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
