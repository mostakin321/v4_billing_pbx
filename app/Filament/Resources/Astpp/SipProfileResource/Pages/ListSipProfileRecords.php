<?php

namespace App\Filament\Resources\Astpp\SipProfileResource\Pages;

use App\Filament\Resources\Astpp\SipProfileResource\SipProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSipProfileRecords extends ListRecords
{
    protected static string $resource = SipProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
