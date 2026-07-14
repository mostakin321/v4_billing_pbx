<?php

namespace App\Filament\Resources\FusionPBX\ContactTimes\Pages;

use App\Filament\Resources\FusionPBX\ContactTimes\ContactTimeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactTime extends EditRecord
{
    protected static string $resource = ContactTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
