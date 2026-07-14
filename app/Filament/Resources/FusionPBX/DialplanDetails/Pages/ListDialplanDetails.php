<?php

namespace App\Filament\Resources\FusionPBX\DialplanDetails\Pages;

use App\Filament\Resources\FusionPBX\DialplanDetails\DialplanDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDialplanDetails extends ListRecords
{
    protected static string $resource = DialplanDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
