<?php

namespace App\Filament\Resources\Astpp\PackagePatternResource\Pages;

use App\Filament\Resources\Astpp\PackagePatternResource\PackagePatternResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPackagePattern extends EditRecord
{
    protected static string $resource = PackagePatternResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
