<?php

namespace App\Filament\Resources\FusionPBX\SipProfiles\Pages;

use App\Filament\Resources\FusionPBX\SipProfiles\SipProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSipProfile extends EditRecord
{
    protected static string $resource = SipProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
