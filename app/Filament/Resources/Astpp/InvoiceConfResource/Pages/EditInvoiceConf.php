<?php

namespace App\Filament\Resources\Astpp\InvoiceConfResource\Pages;

use App\Filament\Resources\Astpp\InvoiceConfResource\InvoiceConfResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceConf extends EditRecord
{
    protected static string $resource = InvoiceConfResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
