<?php

namespace App\Filament\Resources\FusionPBX\NumberTranslations\Pages;

use App\Filament\Resources\FusionPBX\NumberTranslations\NumberTranslationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNumberTranslations extends ListRecords
{
    protected static string $resource = NumberTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
