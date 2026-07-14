<?php

namespace App\Filament\Resources\FusionPBX\FaxLogs\Pages;

use App\Filament\Resources\FusionPBX\FaxLogs\FaxLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFaxLogs extends ListRecords
{
    protected static string $resource = FaxLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
