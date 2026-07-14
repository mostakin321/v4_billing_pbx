<?php

namespace App\Filament\Resources\FusionPBX\Faxes\Pages;

use App\Filament\Resources\FusionPBX\Faxes\FaxResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFax extends EditRecord
{
    protected static string $resource = FaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
