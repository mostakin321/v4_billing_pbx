<?php

namespace App\Filament\Resources\Astpp\PackagePatternResource\Pages;

use App\Filament\Resources\Astpp\PackagePatternResource\PackagePatternResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPackagePatternRecords extends ListRecords
{
    protected static string $resource = PackagePatternResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
