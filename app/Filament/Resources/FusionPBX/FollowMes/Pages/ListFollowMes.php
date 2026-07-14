<?php

namespace App\Filament\Resources\FusionPBX\FollowMes\Pages;

use App\Filament\Resources\FusionPBX\FollowMes\FollowMeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFollowMes extends ListRecords
{
    protected static string $resource = FollowMeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
