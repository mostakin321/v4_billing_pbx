<?php

namespace App\Filament\Resources\Astpp\TaxeResource\Pages;

use App\Filament\Resources\Astpp\TaxeResource\TaxeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaxe extends EditRecord
{
    protected static string $resource = TaxeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
