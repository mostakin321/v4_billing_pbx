<?php

namespace App\Filament\Resources\Astpp\TaxeResource\Pages;

use App\Filament\Resources\Astpp\TaxeResource\TaxeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaxeRecords extends ListRecords
{
    protected static string $resource = TaxeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
