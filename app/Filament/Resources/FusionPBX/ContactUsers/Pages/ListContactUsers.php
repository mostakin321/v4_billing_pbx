<?php

namespace App\Filament\Resources\FusionPBX\ContactUsers\Pages;

use App\Filament\Resources\FusionPBX\ContactUsers\ContactUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactUsers extends ListRecords
{
    protected static string $resource = ContactUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
