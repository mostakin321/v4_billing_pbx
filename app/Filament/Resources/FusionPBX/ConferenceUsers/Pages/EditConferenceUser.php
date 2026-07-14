<?php

namespace App\Filament\Resources\FusionPBX\ConferenceUsers\Pages;

use App\Filament\Resources\FusionPBX\ConferenceUsers\ConferenceUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceUser extends EditRecord
{
    protected static string $resource = ConferenceUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
