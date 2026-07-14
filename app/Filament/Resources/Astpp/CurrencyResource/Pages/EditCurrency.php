<?php

namespace App\Filament\Resources\Astpp\CurrencyResource\Pages;

use App\Filament\Resources\Astpp\CurrencyResource\CurrencyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCurrency extends EditRecord
{
    protected static string $resource = CurrencyResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
