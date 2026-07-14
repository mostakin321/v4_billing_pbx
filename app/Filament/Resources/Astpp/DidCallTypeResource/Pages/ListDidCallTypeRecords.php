<?php

namespace App\Filament\Resources\Astpp\DidCallTypeResource\Pages;

use App\Filament\Resources\Astpp\DidCallTypeResource\DidCallTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDidCallTypeRecords extends ListRecords
{
    protected static string $resource = DidCallTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
