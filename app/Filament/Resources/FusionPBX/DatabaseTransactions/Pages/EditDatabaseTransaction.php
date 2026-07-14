<?php

namespace App\Filament\Resources\FusionPBX\DatabaseTransactions\Pages;

use App\Filament\Resources\FusionPBX\DatabaseTransactions\DatabaseTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDatabaseTransaction extends EditRecord
{
    protected static string $resource = DatabaseTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
