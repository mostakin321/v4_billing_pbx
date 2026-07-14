<?php
namespace App\Filament\Resources\Billing\Invoices\Pages;
use App\Filament\Resources\Billing\Invoices\InvoiceResource;
use Filament\Resources\Pages\EditRecord;
class EditInvoice extends EditRecord {
    protected static string $resource = InvoiceResource::class;
    protected function getHeaderActions(): array { return []; }
}
