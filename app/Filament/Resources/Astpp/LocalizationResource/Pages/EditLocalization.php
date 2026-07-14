<?php

namespace App\Filament\Resources\Astpp\LocalizationResource\Pages;

use App\Filament\Resources\Astpp\LocalizationResource\LocalizationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocalization extends EditRecord
{
    protected static string $resource = LocalizationResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
