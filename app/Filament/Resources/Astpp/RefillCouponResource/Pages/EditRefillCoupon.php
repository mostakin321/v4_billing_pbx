<?php

namespace App\Filament\Resources\Astpp\RefillCouponResource\Pages;

use App\Filament\Resources\Astpp\RefillCouponResource\RefillCouponResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRefillCoupon extends EditRecord
{
    protected static string $resource = RefillCouponResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
