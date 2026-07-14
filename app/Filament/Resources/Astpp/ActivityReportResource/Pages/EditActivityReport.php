<?php

namespace App\Filament\Resources\Astpp\ActivityReportResource\Pages;

use App\Filament\Resources\Astpp\ActivityReportResource\ActivityReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditActivityReport extends EditRecord
{
    protected static string $resource = ActivityReportResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
