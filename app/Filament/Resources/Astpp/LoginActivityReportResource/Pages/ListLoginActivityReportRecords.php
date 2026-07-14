<?php

namespace App\Filament\Resources\Astpp\LoginActivityReportResource\Pages;

use App\Filament\Resources\Astpp\LoginActivityReportResource\LoginActivityReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLoginActivityReportRecords extends ListRecords
{
    protected static string $resource = LoginActivityReportResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
