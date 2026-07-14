<?php

namespace App\Filament\Resources\FusionPBX\FollowMes\Pages;

use App\Filament\Resources\FusionPBX\FollowMes\FollowMeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFollowMe extends EditRecord
{
    protected static string $resource = FollowMeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
