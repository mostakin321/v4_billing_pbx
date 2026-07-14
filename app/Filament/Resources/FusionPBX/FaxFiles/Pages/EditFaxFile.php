<?php

namespace App\Filament\Resources\FusionPBX\FaxFiles\Pages;

use App\Filament\Resources\FusionPBX\FaxFiles\FaxFileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFaxFile extends EditRecord
{
    protected static string $resource = FaxFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
