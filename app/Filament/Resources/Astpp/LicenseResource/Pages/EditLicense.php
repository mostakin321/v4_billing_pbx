<?php

namespace App\Filament\Resources\Astpp\LicenseResource\Pages;

use App\Filament\Resources\Astpp\LicenseResource\LicenseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLicense extends EditRecord
{
    protected static string $resource = LicenseResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
