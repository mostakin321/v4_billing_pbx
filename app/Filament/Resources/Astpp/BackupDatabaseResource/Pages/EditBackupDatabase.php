<?php

namespace App\Filament\Resources\Astpp\BackupDatabaseResource\Pages;

use App\Filament\Resources\Astpp\BackupDatabaseResource\BackupDatabaseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBackupDatabase extends EditRecord
{
    protected static string $resource = BackupDatabaseResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
