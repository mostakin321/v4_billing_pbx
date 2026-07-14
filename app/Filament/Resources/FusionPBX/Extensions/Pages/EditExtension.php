<?php

namespace App\Filament\Resources\FusionPBX\Extensions\Pages;

use App\Filament\Resources\FusionPBX\Extensions\ExtensionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExtension extends EditRecord
{
    protected static string $resource = ExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
