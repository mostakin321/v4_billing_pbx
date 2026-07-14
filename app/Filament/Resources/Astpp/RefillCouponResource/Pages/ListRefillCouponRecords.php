<?php

namespace App\Filament\Resources\Astpp\RefillCouponResource\Pages;

use App\Filament\Resources\Astpp\RefillCouponResource\RefillCouponResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRefillCouponRecords extends ListRecords
{
    protected static string $resource = RefillCouponResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
