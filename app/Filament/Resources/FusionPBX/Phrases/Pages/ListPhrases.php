<?php

namespace App\Filament\Resources\FusionPBX\Phrases\Pages;

use App\Filament\Resources\FusionPBX\Phrases\PhrasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPhrases extends ListRecords
{
    protected static string $resource = PhrasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
