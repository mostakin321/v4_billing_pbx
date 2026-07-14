<?php

namespace App\Filament\Resources\Astpp\AutomatedReportLogResource\Pages;

use App\Filament\Resources\Astpp\AutomatedReportLogResource\AutomatedReportLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAutomatedReportLogRecords extends ListRecords
{
    protected static string $resource = AutomatedReportLogResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
