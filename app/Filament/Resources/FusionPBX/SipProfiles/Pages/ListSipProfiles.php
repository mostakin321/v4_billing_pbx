<?php

namespace App\Filament\Resources\FusionPBX\SipProfiles\Pages;

use App\Filament\Resources\FusionPBX\SipProfiles\SipProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSipProfiles extends ListRecords
{
    protected static string $resource = SipProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
