<?php

namespace App\Filament\Resources\FusionPBX\PhraseDetails\Pages;

use App\Filament\Resources\FusionPBX\PhraseDetails\PhraseDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPhraseDetails extends ListRecords
{
    protected static string $resource = PhraseDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
