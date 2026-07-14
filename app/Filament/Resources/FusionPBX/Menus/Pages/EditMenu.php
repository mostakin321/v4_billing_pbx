<?php

namespace App\Filament\Resources\FusionPBX\Menus\Pages;

use App\Filament\Resources\FusionPBX\Menus\MenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
