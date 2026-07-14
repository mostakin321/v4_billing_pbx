<?php

namespace App\Filament\Resources\FusionPBX\VoicemailGreetings\Pages;

use App\Filament\Resources\FusionPBX\VoicemailGreetings\VoicemailGreetingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoicemailGreetings extends ListRecords
{
    protected static string $resource = VoicemailGreetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
