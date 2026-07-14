<?php

namespace App\Filament\Resources\Astpp\PaymentTransactionResource\Pages;

use App\Filament\Resources\Astpp\PaymentTransactionResource\PaymentTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPaymentTransaction extends EditRecord
{
    protected static string $resource = PaymentTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
