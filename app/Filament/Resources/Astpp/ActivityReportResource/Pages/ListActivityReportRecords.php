<?php

namespace App\Filament\Resources\Astpp\ActivityReportResource\Pages;

use App\Filament\Resources\Astpp\ActivityReportResource\ActivityReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActivityReportRecords extends ListRecords
{
    protected static string $resource = ActivityReportResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
