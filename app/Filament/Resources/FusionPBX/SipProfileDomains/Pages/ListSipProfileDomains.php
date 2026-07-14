<?php

namespace App\Filament\Resources\FusionPBX\SipProfileDomains\Pages;

use App\Filament\Resources\FusionPBX\SipProfileDomains\SipProfileDomainResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSipProfileDomains extends ListRecords
{
    protected static string $resource = SipProfileDomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
