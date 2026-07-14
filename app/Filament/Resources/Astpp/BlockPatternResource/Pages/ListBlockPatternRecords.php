<?php

namespace App\Filament\Resources\Astpp\BlockPatternResource\Pages;

use App\Filament\Resources\Astpp\BlockPatternResource\BlockPatternResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBlockPatternRecords extends ListRecords
{
    protected static string $resource = BlockPatternResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
