<?php
namespace App\Filament\Resources\Billing\Invoices\Pages;
use App\Filament\Resources\Billing\Invoices\InvoiceResource;
use Filament\Resources\Pages\ListRecords;
class ListInvoices extends ListRecords {
    protected static string $resource = InvoiceResource::class;
    protected function getHeaderActions(): array { return []; }
}
