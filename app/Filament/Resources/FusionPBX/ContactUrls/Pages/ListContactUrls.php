<?php

namespace App\Filament\Resources\FusionPBX\ContactUrls\Pages;

use App\Filament\Resources\FusionPBX\ContactUrls\ContactUrlResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactUrls extends ListRecords
{
    protected static string $resource = ContactUrlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
