<?php

namespace App\Filament\Resources\Astpp\ReportsProcessListResource\Pages;

use App\Filament\Resources\Astpp\ReportsProcessListResource\ReportsProcessListResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReportsProcessList extends EditRecord
{
    protected static string $resource = ReportsProcessListResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
