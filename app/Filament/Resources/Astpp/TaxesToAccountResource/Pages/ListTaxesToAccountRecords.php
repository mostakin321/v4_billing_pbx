<?php

namespace App\Filament\Resources\Astpp\TaxesToAccountResource\Pages;

use App\Filament\Resources\Astpp\TaxesToAccountResource\TaxesToAccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaxesToAccountRecords extends ListRecords
{
    protected static string $resource = TaxesToAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
