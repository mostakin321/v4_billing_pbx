<?php

namespace App\Filament\Resources\FusionPBX\MenuLanguages\Pages;

use App\Filament\Resources\FusionPBX\MenuLanguages\MenuLanguageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuLanguages extends ListRecords
{
    protected static string $resource = MenuLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
