<?php

namespace App\Filament\Resources\FusionPBX\MenuItems\Pages;

use App\Filament\Resources\FusionPBX\MenuItems\MenuItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuItem extends EditRecord
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
