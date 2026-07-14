<?php

namespace App\Filament\Resources\FusionPBX\Faxes\Pages;

use App\Filament\Resources\FusionPBX\Faxes\FaxResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFaxes extends ListRecords
{
    protected static string $resource = FaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
