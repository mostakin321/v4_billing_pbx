<?php

namespace App\Filament\Resources\Astpp\CountryCodeResource\Pages;

use App\Filament\Resources\Astpp\CountryCodeResource\CountryCodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCountryCodeRecords extends ListRecords
{
    protected static string $resource = CountryCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
