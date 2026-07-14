<?php

namespace App\Filament\Resources\Astpp\InvoiceDetailResource\Pages;

use App\Filament\Resources\Astpp\InvoiceDetailResource\InvoiceDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceDetailRecords extends ListRecords
{
    protected static string $resource = InvoiceDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
