<?php

namespace App\Filament\Resources\FusionPBX\ExtensionUsers\Pages;

use App\Filament\Resources\FusionPBX\ExtensionUsers\ExtensionUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExtensionUser extends EditRecord
{
    protected static string $resource = ExtensionUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
