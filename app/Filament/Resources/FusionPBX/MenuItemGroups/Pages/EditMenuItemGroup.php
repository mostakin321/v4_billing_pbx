<?php

namespace App\Filament\Resources\FusionPBX\MenuItemGroups\Pages;

use App\Filament\Resources\FusionPBX\MenuItemGroups\MenuItemGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuItemGroup extends EditRecord
{
    protected static string $resource = MenuItemGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
