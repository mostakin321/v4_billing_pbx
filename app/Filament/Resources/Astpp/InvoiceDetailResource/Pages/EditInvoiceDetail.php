<?php

namespace App\Filament\Resources\Astpp\InvoiceDetailResource\Pages;

use App\Filament\Resources\Astpp\InvoiceDetailResource\InvoiceDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceDetail extends EditRecord
{
    protected static string $resource = InvoiceDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
