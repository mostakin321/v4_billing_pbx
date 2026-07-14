<?php
namespace App\Filament\Customer\Resources\Invoices\Pages;

use App\Filament\Customer\Resources\Invoices\CustomerInvoiceResource;
use Filament\Resources\Pages\ListRecords;

class ListCustomerInvoices extends ListRecords
{
    protected static string $resource = CustomerInvoiceResource::class;
    protected function getHeaderActions(): array { return []; }
}
