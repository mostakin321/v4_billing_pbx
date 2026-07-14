<?php

namespace App\Filament\Resources\Astpp\PaymentTransactionResource\Pages;

use App\Filament\Resources\Astpp\PaymentTransactionResource\PaymentTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPaymentTransactionRecords extends ListRecords
{
    protected static string $resource = PaymentTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
