<?php

namespace App\Filament\Resources\FusionPBX\DatabaseTransactions\Pages;

use App\Filament\Resources\FusionPBX\DatabaseTransactions\DatabaseTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDatabaseTransactions extends ListRecords
{
    protected static string $resource = DatabaseTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
