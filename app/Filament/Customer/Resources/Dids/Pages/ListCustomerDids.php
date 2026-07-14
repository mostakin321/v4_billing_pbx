<?php
namespace App\Filament\Customer\Resources\Dids\Pages;

use App\Filament\Customer\Resources\Dids\CustomerDidResource;
use Filament\Resources\Pages\ListRecords;

class ListCustomerDids extends ListRecords
{
    protected static string $resource = CustomerDidResource::class;
    protected function getHeaderActions(): array { return []; }
}
