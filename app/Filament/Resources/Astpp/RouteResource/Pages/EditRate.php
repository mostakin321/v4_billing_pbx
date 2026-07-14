<?php
namespace App\Filament\Resources\Astpp\RouteResource\Pages;
use App\Filament\Resources\Astpp\RouteResource\RateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditRate extends EditRecord {
    protected static string $resource = RateResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
