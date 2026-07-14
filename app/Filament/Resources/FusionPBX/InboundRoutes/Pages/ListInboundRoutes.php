<?php
namespace App\Filament\Resources\FusionPBX\InboundRoutes\Pages;
use App\Filament\Resources\FusionPBX\InboundRoutes\InboundRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListInboundRoutes extends ListRecords {
    protected static string $resource = InboundRouteResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
