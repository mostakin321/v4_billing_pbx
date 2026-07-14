<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfileParams\Pages;

use App\Filament\Resources\FusionPBX\ConferenceProfileParams\ConferenceProfileParamResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceProfileParams extends ListRecords
{
    protected static string $resource = ConferenceProfileParamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
