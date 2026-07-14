<?php

namespace App\Filament\Resources\Astpp\MenuModuleResource\Pages;

use App\Filament\Resources\Astpp\MenuModuleResource\MenuModuleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuModuleRecords extends ListRecords
{
    protected static string $resource = MenuModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
