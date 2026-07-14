<?php

namespace App\Filament\Resources\Astpp\UsertrackingResource\Pages;

use App\Filament\Resources\Astpp\UsertrackingResource\UsertrackingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsertrackingRecords extends ListRecords
{
    protected static string $resource = UsertrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
