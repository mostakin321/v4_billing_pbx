<?php

namespace App\Filament\Resources\FusionPBX\FifoMembers\Pages;

use App\Filament\Resources\FusionPBX\FifoMembers\FifoMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFifoMember extends EditRecord
{
    protected static string $resource = FifoMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
