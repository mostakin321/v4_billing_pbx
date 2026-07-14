<?php

namespace App\Filament\Resources\FusionPBX\ExtensionUsers\Pages;

use App\Filament\Resources\FusionPBX\ExtensionUsers\ExtensionUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExtensionUsers extends ListRecords
{
    protected static string $resource = ExtensionUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
