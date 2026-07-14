<?php

namespace App\Filament\Resources\FusionPBX\Streams\Pages;

use App\Filament\Resources\FusionPBX\Streams\StreamResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStreams extends ListRecords
{
    protected static string $resource = StreamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
