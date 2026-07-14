<?php

namespace App\Filament\Resources\FusionPBX\Domains\Pages;

use App\Filament\Resources\FusionPBX\Domains\DomainResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDomain extends EditRecord
{
    protected static string $resource = DomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
