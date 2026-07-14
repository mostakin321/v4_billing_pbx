<?php

namespace App\Filament\Resources\FusionPBX\IvrMenus\Pages;

use App\Filament\Resources\FusionPBX\IvrMenus\IvrMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIvrMenu extends EditRecord
{
    protected static string $resource = IvrMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
