<?php

namespace App\Filament\Resources\Astpp\InvoiceResource\Pages;

use App\Filament\Resources\Astpp\InvoiceResource\InvoiceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceRecords extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
