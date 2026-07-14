<?php
namespace App\Filament\Resources\Astpp\InvoiceResource\Pages;
use App\Filament\Resources\Astpp\InvoiceResource\InvoiceResource;
use Filament\Resources\Pages\EditRecord;
class EditInvoice extends EditRecord {
    protected static string $resource = InvoiceResource::class;
    protected function getHeaderActions(): array { return []; }
}
