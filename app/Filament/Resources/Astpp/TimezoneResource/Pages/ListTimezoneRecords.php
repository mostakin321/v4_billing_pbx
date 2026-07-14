<?php

namespace App\Filament\Resources\Astpp\TimezoneResource\Pages;

use App\Filament\Resources\Astpp\TimezoneResource\TimezoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTimezoneRecords extends ListRecords
{
    protected static string $resource = TimezoneResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
