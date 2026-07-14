<?php

namespace App\Filament\Resources\Astpp\InvoiceConfResource\Pages;

use App\Filament\Resources\Astpp\InvoiceConfResource\InvoiceConfResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceConfRecords extends ListRecords
{
    protected static string $resource = InvoiceConfResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
