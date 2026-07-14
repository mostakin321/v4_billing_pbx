<?php
namespace App\Filament\Customer\Resources\Cdrs\Pages;

use App\Filament\Customer\Resources\Cdrs\CustomerCdrResource;
use Filament\Resources\Pages\ListRecords;

class ListCustomerCdrs extends ListRecords
{
    protected static string $resource = CustomerCdrResource::class;
    protected function getHeaderActions(): array { return []; }
}
