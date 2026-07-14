<?php

namespace App\Filament\Resources\FusionPBX\Voicemails\Pages;

use App\Filament\Resources\FusionPBX\Voicemails\VoicemailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoicemails extends ListRecords
{
    protected static string $resource = VoicemailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
