<?php

namespace App\Filament\Resources\FusionPBX\FaxUsers\Pages;

use App\Filament\Resources\FusionPBX\FaxUsers\FaxUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFaxUser extends EditRecord
{
    protected static string $resource = FaxUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
