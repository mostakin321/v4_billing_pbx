<?php

namespace App\Filament\Resources\FusionPBX\VoicemailOptions\Pages;

use App\Filament\Resources\FusionPBX\VoicemailOptions\VoicemailOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoicemailOptions extends ListRecords
{
    protected static string $resource = VoicemailOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
