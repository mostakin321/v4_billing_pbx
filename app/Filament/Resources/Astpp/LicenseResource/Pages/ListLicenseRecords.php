<?php

namespace App\Filament\Resources\Astpp\LicenseResource\Pages;

use App\Filament\Resources\Astpp\LicenseResource\LicenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLicenseRecords extends ListRecords
{
    protected static string $resource = LicenseResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
