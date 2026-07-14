<?php

namespace App\Filament\Resources\FusionPBX\Fifos\Pages;

use App\Filament\Resources\FusionPBX\Fifos\FifoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFifos extends ListRecords
{
    protected static string $resource = FifoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
