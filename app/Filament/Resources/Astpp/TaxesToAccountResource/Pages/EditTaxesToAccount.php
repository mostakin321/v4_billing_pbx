<?php

namespace App\Filament\Resources\Astpp\TaxesToAccountResource\Pages;

use App\Filament\Resources\Astpp\TaxesToAccountResource\TaxesToAccountResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaxesToAccount extends EditRecord
{
    protected static string $resource = TaxesToAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
