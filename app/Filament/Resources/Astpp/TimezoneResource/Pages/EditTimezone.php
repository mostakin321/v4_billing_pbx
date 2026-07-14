<?php

namespace App\Filament\Resources\Astpp\TimezoneResource\Pages;

use App\Filament\Resources\Astpp\TimezoneResource\TimezoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTimezone extends EditRecord
{
    protected static string $resource = TimezoneResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
