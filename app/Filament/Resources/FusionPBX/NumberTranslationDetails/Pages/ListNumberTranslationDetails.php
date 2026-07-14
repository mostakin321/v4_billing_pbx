<?php

namespace App\Filament\Resources\FusionPBX\NumberTranslationDetails\Pages;

use App\Filament\Resources\FusionPBX\NumberTranslationDetails\NumberTranslationDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNumberTranslationDetails extends ListRecords
{
    protected static string $resource = NumberTranslationDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
