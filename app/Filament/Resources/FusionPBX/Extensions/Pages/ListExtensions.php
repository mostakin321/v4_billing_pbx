<?php

namespace App\Filament\Resources\FusionPBX\Extensions\Pages;

use App\Filament\Resources\FusionPBX\Extensions\ExtensionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExtensions extends ListRecords
{
    protected static string $resource = ExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
