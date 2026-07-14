<?php

namespace App\Filament\Resources\Astpp\PaymentTransactionResource\Pages;

use App\Filament\Resources\Astpp\PaymentTransactionResource\PaymentTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentTransaction extends CreateRecord
{
    protected static string $resource = PaymentTransactionResource::class;
}
