<?php

namespace App\Filament\Resources\Astpp\AutomatedReportLogResource\Pages;

use App\Filament\Resources\Astpp\AutomatedReportLogResource\AutomatedReportLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAutomatedReportLog extends EditRecord
{
    protected static string $resource = AutomatedReportLogResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
