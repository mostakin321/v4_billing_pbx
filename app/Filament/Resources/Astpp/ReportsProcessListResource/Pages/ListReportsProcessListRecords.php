<?php

namespace App\Filament\Resources\Astpp\ReportsProcessListResource\Pages;

use App\Filament\Resources\Astpp\ReportsProcessListResource\ReportsProcessListResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReportsProcessListRecords extends ListRecords
{
    protected static string $resource = ReportsProcessListResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
