<?php

namespace App\Filament\Resources\FusionPBX\Vars\Pages;

use App\Filament\Resources\FusionPBX\Vars\VarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVar extends EditRecord
{
    protected static string $resource = VarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
