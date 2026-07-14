<?php

namespace App\Filament\Resources\Astpp\UserlevelResource\Pages;

use App\Filament\Resources\Astpp\UserlevelResource\UserlevelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserlevelRecords extends ListRecords
{
    protected static string $resource = UserlevelResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
