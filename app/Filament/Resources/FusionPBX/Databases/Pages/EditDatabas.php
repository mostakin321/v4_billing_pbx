<?php

namespace App\Filament\Resources\FusionPBX\Databases\Pages;

use App\Filament\Resources\FusionPBX\Databases\DatabasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDatabas extends EditRecord
{
    protected static string $resource = DatabasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
