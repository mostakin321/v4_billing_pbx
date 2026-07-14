<?php

namespace App\Filament\Resources\FusionPBX\IvrMenuOptions\Pages;

use App\Filament\Resources\FusionPBX\IvrMenuOptions\IvrMenuOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIvrMenuOption extends EditRecord
{
    protected static string $resource = IvrMenuOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
