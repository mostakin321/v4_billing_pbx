<?php

namespace App\Filament\Resources\Astpp\ResellerProductResource\Pages;

use App\Filament\Resources\Astpp\ResellerProductResource\ResellerProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResellerProduct extends EditRecord
{
    protected static string $resource = ResellerProductResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
