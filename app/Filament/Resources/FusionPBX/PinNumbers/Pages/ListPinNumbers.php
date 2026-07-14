<?php

namespace App\Filament\Resources\FusionPBX\PinNumbers\Pages;

use App\Filament\Resources\FusionPBX\PinNumbers\PinNumberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPinNumbers extends ListRecords
{
    protected static string $resource = PinNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
