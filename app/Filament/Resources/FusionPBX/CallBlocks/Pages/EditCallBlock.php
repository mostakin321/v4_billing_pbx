<?php

namespace App\Filament\Resources\FusionPBX\CallBlocks\Pages;

use App\Filament\Resources\FusionPBX\CallBlocks\CallBlockResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallBlock extends EditRecord
{
    protected static string $resource = CallBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
