<?php

namespace App\Filament\Resources\FusionPBX\PinNumbers\Pages;

use App\Filament\Resources\FusionPBX\PinNumbers\PinNumberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPinNumber extends EditRecord
{
    protected static string $resource = PinNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
