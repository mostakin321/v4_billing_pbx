<?php

namespace App\Filament\Resources\Astpp\SpeedDialResource\Pages;

use App\Filament\Resources\Astpp\SpeedDialResource\SpeedDialResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpeedDial extends EditRecord
{
    protected static string $resource = SpeedDialResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
