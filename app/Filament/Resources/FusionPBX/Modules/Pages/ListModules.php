<?php

namespace App\Filament\Resources\FusionPBX\Modules\Pages;

use App\Filament\Resources\FusionPBX\Modules\ModuleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
