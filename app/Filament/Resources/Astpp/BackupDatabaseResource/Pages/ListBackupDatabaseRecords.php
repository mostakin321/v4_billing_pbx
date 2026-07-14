<?php

namespace App\Filament\Resources\Astpp\BackupDatabaseResource\Pages;

use App\Filament\Resources\Astpp\BackupDatabaseResource\BackupDatabaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBackupDatabaseRecords extends ListRecords
{
    protected static string $resource = BackupDatabaseResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
