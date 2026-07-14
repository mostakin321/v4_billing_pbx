<?php

namespace App\Filament\Resources\Astpp\BlockPatternResource\Pages;

use App\Filament\Resources\Astpp\BlockPatternResource\BlockPatternResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBlockPattern extends EditRecord
{
    protected static string $resource = BlockPatternResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
