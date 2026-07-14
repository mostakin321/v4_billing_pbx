<?php
namespace App\Filament\Resources\Astpp\RouteResource\Pages;
use App\Filament\Resources\Astpp\RouteResource\OriginationRateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditOriginationRate extends EditRecord {
    protected static string $resource = OriginationRateResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
