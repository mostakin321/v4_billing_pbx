<?php

namespace App\Filament\Resources\FusionPBX\VoicemailMessages\Pages;

use App\Filament\Resources\FusionPBX\VoicemailMessages\VoicemailMessageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoicemailMessages extends ListRecords
{
    protected static string $resource = VoicemailMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
