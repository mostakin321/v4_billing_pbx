<?php
namespace App\Filament\Resources\FusionPBX\InboundRoutes\Pages;
use App\Filament\Resources\FusionPBX\InboundRoutes\InboundRouteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditInboundRoute extends EditRecord {
    protected static string $resource = InboundRouteResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
