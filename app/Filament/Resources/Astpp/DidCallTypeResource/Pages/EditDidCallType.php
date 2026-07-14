<?php

namespace App\Filament\Resources\Astpp\DidCallTypeResource\Pages;

use App\Filament\Resources\Astpp\DidCallTypeResource\DidCallTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDidCallType extends EditRecord
{
    protected static string $resource = DidCallTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
