<?php

namespace App\Filament\Resources\Astpp\MenuModuleResource\Pages;

use App\Filament\Resources\Astpp\MenuModuleResource\MenuModuleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuModule extends EditRecord
{
    protected static string $resource = MenuModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
