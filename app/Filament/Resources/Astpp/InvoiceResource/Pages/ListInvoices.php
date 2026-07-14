<?php
namespace App\Filament\Resources\Astpp\InvoiceResource\Pages;
use App\Filament\Resources\Astpp\InvoiceResource\InvoiceResource;
use Filament\Resources\Pages\ListRecords;
class ListInvoices extends ListRecords {
    protected static string $resource = InvoiceResource::class;
    protected function getHeaderActions(): array { return []; }
}
