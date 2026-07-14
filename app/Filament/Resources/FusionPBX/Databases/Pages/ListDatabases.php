<?php

namespace App\Filament\Resources\FusionPBX\Databases\Pages;

use App\Filament\Resources\FusionPBX\Databases\DatabasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDatabases extends ListRecords
{
    protected static string $resource = DatabasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
