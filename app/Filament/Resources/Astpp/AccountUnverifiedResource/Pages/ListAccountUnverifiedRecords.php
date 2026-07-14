<?php

namespace App\Filament\Resources\Astpp\AccountUnverifiedResource\Pages;

use App\Filament\Resources\Astpp\AccountUnverifiedResource\AccountUnverifiedResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccountUnverifiedRecords extends ListRecords
{
    protected static string $resource = AccountUnverifiedResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
