<?php
namespace App\Filament\Resources\Billing\Pricelists\Pages;
use App\Filament\Resources\Billing\Pricelists\PricelistResource;
use Filament\Resources\Pages\CreateRecord;
class CreatePricelist extends CreateRecord {
    protected static string $resource = PricelistResource::class;
}
