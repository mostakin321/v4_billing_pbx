<?php

namespace App\Filament\Resources\Astpp\UserlevelResource\Pages;

use App\Filament\Resources\Astpp\UserlevelResource\UserlevelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserlevel extends EditRecord
{
    protected static string $resource = UserlevelResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
