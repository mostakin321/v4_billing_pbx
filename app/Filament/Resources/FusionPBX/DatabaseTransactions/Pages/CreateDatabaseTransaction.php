<?php

namespace App\Filament\Resources\FusionPBX\DatabaseTransactions\Pages;

use App\Filament\Resources\FusionPBX\DatabaseTransactions\DatabaseTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDatabaseTransaction extends CreateRecord
{
    protected static string $resource = DatabaseTransactionResource::class;
}
