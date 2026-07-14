<?php

namespace App\Filament\Resources\FusionPBX\SipProfileDomains\Pages;

use App\Filament\Resources\FusionPBX\SipProfileDomains\SipProfileDomainResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSipProfileDomain extends EditRecord
{
    protected static string $resource = SipProfileDomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
