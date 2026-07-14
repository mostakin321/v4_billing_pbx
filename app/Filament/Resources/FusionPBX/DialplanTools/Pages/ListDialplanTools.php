<?php

namespace App\Filament\Resources\FusionPBX\DialplanTools\Pages;

use App\Filament\Resources\FusionPBX\DialplanTools\DialplanToolResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDialplanTools extends ListRecords
{
    protected static string $resource = DialplanToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
