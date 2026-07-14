<?php

namespace App\Filament\Resources\FusionPBX\FaxUsers\Pages;

use App\Filament\Resources\FusionPBX\FaxUsers\FaxUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFaxUsers extends ListRecords
{
    protected static string $resource = FaxUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
