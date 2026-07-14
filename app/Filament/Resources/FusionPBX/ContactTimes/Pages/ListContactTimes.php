<?php

namespace App\Filament\Resources\FusionPBX\ContactTimes\Pages;

use App\Filament\Resources\FusionPBX\ContactTimes\ContactTimeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactTimes extends ListRecords
{
    protected static string $resource = ContactTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
