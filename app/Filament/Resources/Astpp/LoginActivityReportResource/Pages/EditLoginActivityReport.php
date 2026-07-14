<?php

namespace App\Filament\Resources\Astpp\LoginActivityReportResource\Pages;

use App\Filament\Resources\Astpp\LoginActivityReportResource\LoginActivityReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLoginActivityReport extends EditRecord
{
    protected static string $resource = LoginActivityReportResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
